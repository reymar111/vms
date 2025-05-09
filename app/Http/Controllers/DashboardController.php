<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $current_year = $request->current_year;

        $violation_summary = DB::table('transaction_violations as tv')
            ->join('violations as v', 'tv.violation_id', '=', 'v.id')
            ->join('academic_years as ay', 'tv.academic_year_id', '=', 'ay.id')
            ->join('violation_categories as vc', 'v.violation_category_id', '=', 'vc.id')
            ->leftJoin(DB::raw('(SELECT offense_level_id, COUNT(*) as count FROM transaction_violations GROUP BY offense_level_id ORDER BY count DESC LIMIT 1) as common_offense'), function ($join) {
                $join->on('tv.offense_level_id', '=', 'common_offense.offense_level_id');
            })
            ->leftJoin(DB::raw('(SELECT penalty_action_id, COUNT(*) as count FROM transaction_violations GROUP BY penalty_action_id ORDER BY count DESC LIMIT 1) as common_penalty'), function ($join) {
                $join->on('tv.penalty_action_id', '=', 'common_penalty.penalty_action_id');
            })
            ->when($current_year, function ($query) use ($request) {
                $query->where('ay.year', $request->current_year);
            })
            ->select(
                'v.code as violation_code',
                'v.name as violation_name',
                'vc.name as category',
                DB::raw('COUNT(tv.id) as total_cases')
            )
            ->groupBy('v.code', 'v.name', 'vc.name')
            ->orderByDesc('total_cases')
            ->get();


            $monthly_violations = DB::table('transaction_violations')
            ->join('academic_years', 'transaction_violations.academic_year_id', '=', 'academic_years.id')
            ->when($request->current_year, function ($query) use ($request) {
                $query->where('academic_years.year', $request->current_year);
            })
            ->select(
                DB::raw("YEAR(transaction_violations.created_at) as year"),
                DB::raw("MONTH(transaction_violations.created_at) as month_number"),
                DB::raw("DATE_FORMAT(transaction_violations.created_at, '%M') as month"),
                DB::raw("COUNT(transaction_violations.id) as total_violations")
            )
            ->groupBy(
                DB::raw("YEAR(transaction_violations.created_at)"),
                DB::raw("MONTH(transaction_violations.created_at)"),
                DB::raw("DATE_FORMAT(transaction_violations.created_at, '%M')")
            )
            ->orderBy('year')
            ->orderBy('month_number')
            ->get();



            $violations_per_academic_year = DB::table('transaction_violations')
            ->join('academic_years', 'transaction_violations.academic_year_id', '=', 'academic_years.id')
            ->join('semesters', 'academic_years.semester_id', '=', 'semesters.id')
            ->select(
                DB::raw("CONCAT(academic_years.code, ' - ', semesters.name) as academic_year"),
                DB::raw('COUNT(transaction_violations.id) as total_violations'),
                'academic_years.year',
                'academic_years.semester_id'
            )
            ->when($current_year, function ($query) use ($current_year) {
                $query->where('academic_years.year', $current_year);
            })
            ->groupBy(
                'academic_years.code',
                'semesters.name',
                'academic_years.year',
                'academic_years.semester_id'
            )
            ->orderBy('academic_years.year', 'desc')
            ->orderBy('academic_years.semester_id', 'desc')
            ->get()
            ->map(function ($item) {
                // Optionally remove year and semester_id from the final output
                unset($item->year, $item->semester_id);
                return $item;
            });


        $violation_status = DB::table('transaction_violations as tv')
            ->join('statuses as s', 'tv.status_id', '=', 's.id')
            ->join('academic_years', 'tv.academic_year_id', '=', 'academic_years.id')
            ->select(
                's.name as status',
                DB::raw('COUNT(tv.id) as total_cases')
            )
            ->when($current_year, function ($query) use ($current_year) {
                $query->where('academic_years.year', $current_year);
            })
            ->groupBy('s.name')
            ->orderByDesc('total_cases')
            ->get();

        $top_violations = DB::table('transaction_violations')
            ->join('violations', 'transaction_violations.violation_id', '=', 'violations.id')
            ->join('academic_years', 'transaction_violations.academic_year_id', '=', 'academic_years.id')
            ->when($current_year, function ($query) use ($current_year) {
                $query->where('academic_years.year', $current_year);
            })
            ->select(
                'violations.name',
                DB::raw('COUNT(transaction_violations.id) as total')
            )
            ->groupBy('violations.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

            $years = DB::table('academic_years')
                    ->orderByDesc('year')
                    ->select('year')
                    ->distinct() // Use distinct to get unique values for the year column
                    ->get();


        return Inertia::render('Dashboard', [
            'violation_summary' => $violation_summary,
            'monthly_violations' => $monthly_violations,
            'violations_per_academic_year' => $violations_per_academic_year,
            'violation_status' => $violation_status,
            'top_violations' => $top_violations,
            'years' => $years,
        ]);
    }
}
