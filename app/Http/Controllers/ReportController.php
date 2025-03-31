<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function violationsPerAcademicYear()
    {
        $data = DB::table('transaction_violations')
            ->join('academic_years', 'transaction_violations.academic_year_id', '=', 'academic_years.id')
            ->join('semesters', 'academic_years.semester_id', '='   , 'semesters.id')
            ->select(
                DB::raw("CONCAT(academic_years.code, ' - ', semesters.name) as academic_year"),
                DB::raw('COUNT(transaction_violations.id) as total_violations')
            )
            ->groupBy('academic_years.code', 'semesters.name')
            ->get();

        return Inertia::render('Report/ViolationPerAcademicYear',
        [
            'data' => $data,
        ]);

    }

    public function violationsPerCollege()
    {
        $data = DB::table('transaction_violations')
            ->join('students', 'transaction_violations.student_id', '=', 'students.id')
            ->join('programs', 'students.program_id', '=', 'programs.id')
            ->join('colleges', 'programs.college_id', '=', 'colleges.id')
            ->select(
                'colleges.description as college_name',
                DB::raw('COUNT(transaction_violations.id) as total_violations')
            )
            ->groupBy('colleges.description')
            ->get();

            return Inertia::render('Report/ViolationPerCollege',
            [
                'data' => $data,
            ]);
    }

    public function monthlyViolations()
    {
        $data = DB::table('transaction_violations')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%M') as month"), // Full month name
                DB::raw("MONTH(created_at) as month_number"), // Needed for correct sorting
                DB::raw("YEAR(created_at) as year"), // Grouping by year to avoid mix-ups
                DB::raw("COUNT(id) as total_violations")
            )
            ->groupBy('year', 'month', 'month_number')
            ->orderBy('year')
            ->orderBy('month_number') // Ensures months are sorted correctly
            ->get();

        return Inertia::render('Report/MonthlyViolations', [
            'data' => $data,
        ]);
    }

    public function topViolations()
    {
        $data = DB::table('transaction_violations')
            ->join('violations', 'transaction_violations.violation_id', '=', 'violations.id')
            ->select(
                'violations.name',
                DB::raw('COUNT(transaction_violations.id) as total')
            )
            ->groupBy('violations.name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

            return Inertia::render('Report/TopViolations', [
                'data' => $data,
            ]);
    }

    public function violationSummary()
    {
        $data = DB::table('transaction_violations as tv')
            ->join('violations as v', 'tv.violation_id', '=', 'v.id')
            ->join('violation_categories as vc', 'v.violation_category_id', '=', 'vc.id')
            ->leftJoin(DB::raw('(SELECT offense_level_id, COUNT(*) as count FROM transaction_violations GROUP BY offense_level_id ORDER BY count DESC LIMIT 1) as common_offense'), function ($join) {
                $join->on('tv.offense_level_id', '=', 'common_offense.offense_level_id');
            })
            ->leftJoin(DB::raw('(SELECT penalty_action_id, COUNT(*) as count FROM transaction_violations GROUP BY penalty_action_id ORDER BY count DESC LIMIT 1) as common_penalty'), function ($join) {
                $join->on('tv.penalty_action_id', '=', 'common_penalty.penalty_action_id');
            })
            ->select(
                'v.code as violation_code',
                'v.name as violation_name',
                'vc.name as category',
                DB::raw('COUNT(tv.id) as total_cases'),
                DB::raw('common_offense.offense_level_id as most_common_offense_level'),
                DB::raw('common_penalty.penalty_action_id as most_common_penalty')
            )
            ->groupBy('v.id', 'v.code', 'v.name', 'vc.name', 'common_offense.offense_level_id', 'common_penalty.penalty_action_id')
            ->orderByDesc('total_cases')
            ->get();

        return Inertia::render('Report/ViolationSummary', [
            'data' => $data,
        ]);
    }

    public function violationStatus()
    {
        $data = DB::table('transaction_violations as tv')
            ->join('statuses as s', 'tv.status_id', '=', 's.id')
            ->select(
                's.name as status',
                DB::raw('COUNT(tv.id) as total_cases')
            )
            ->groupBy('s.name')
            ->orderByDesc('total_cases')
            ->get();

        return Inertia::render('Report/ViolationStatus', [
            'data' => $data,
        ]);
    }

}
