<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Inertia\Inertia;
use App\Models\Status;
use App\Models\Student;
use App\Models\Violation;
use Illuminate\Support\Str;
use App\Models\OffenseLevel;
use Illuminate\Http\Request;
use App\Models\PenaltyAction;
use App\Models\ViolationCategory;
use App\Models\TransactionViolation;

class TransactionViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $violations = TransactionViolation::with([
            'student',
            'violation',
            'offense_level',
            'penalty_action',
            'status'
        ])
        ->orderBy('created_at', 'desc')
        ->get();


        // $violations = Violation::all();
        // $offense_levels = OffenseLevel::all();
        $penalty_actions = PenaltyAction::all();

        $statuses = Status::all();

        return Inertia::render('TransactionViolation',
        [
            'violations' => $violations,
            // 'offense_levels' => $offense_levels,
            'penalty_actions' => $penalty_actions,
            'statuses' => $statuses,
        ]);
    }

    public function create()
    {
        $violations = Violation::with('category')->get();
        $offense_levels = OffenseLevel::all();
        $penalty_actions = PenaltyAction::all();
        $statuses = Status::all();
        $transaction_number = 'VLN-'.Str::random(6);
        $students = Student::with(['program', 'year_level', 'section'])->get();
        $academic_years = AcademicYear::with('semester')->orderBy('year', 'desc')->orderBy('semester_id', 'asc')->get();

        return Inertia::render('CreateViolation',
        [
            'violations' => $violations,
            'offense_levels' => $offense_levels,
            'penalty_actions' => $penalty_actions,
            'statuses' => $statuses,
            'transaction_number' => $transaction_number,
            'students' => $students,
            'academic_years' => $academic_years,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => ['required'],
            'violation_id' => ['required'],
            'academic_year_id' => ['required'],
        ]);

        $violation = new TransactionViolation();
        $violation->transaction_number = 'VLN-'.Str::random(6);
        $violation->student_id = $request->student_id;
        $violation->violation_id = $request->violation_id;
        $violation->academic_year_id = $request->academic_year_id;
        $violation->offense_level_id = $request->offense_level_id;
        $violation->status_id = 1;
        $violation->remarks = $request->remarks;
        $violation->save();

        return to_route('transaction_violation.index');

    }

    public function show(TransactionViolation $transaction_violation)
    {
        $violations = Violation::with('category')->get();
        $offense_levels = OffenseLevel::all();
        $penalty_actions = PenaltyAction::all();
        $statuses = Status::all();
        $students = Student::with(['program', 'year_level', 'section'])->get();
        $academic_years = AcademicYear::with('semester')->orderBy('year', 'desc')->orderBy('semester_id', 'asc')->get();

        return Inertia::render('ViewViolation',
        [
            'violation' => $transaction_violation->load([
                'student',
                'violation',
                'offense_level',
                'penalty_action',
                'status'
            ]),
            'violations' => $violations,
            'offense_levels' => $offense_levels,
            'penalty_actions' => $penalty_actions,
            'statuses' => $statuses,
            'students' => $students,
            'academic_years' => $academic_years,
        ]);

    }

    public function edit(TransactionViolation $transaction_violation)
    {
        $violations = Violation::with('category')->get();
        $offense_levels = OffenseLevel::all();
        $penalty_actions = PenaltyAction::all();
        $statuses = Status::all();
        $students = Student::with(['program', 'year_level', 'section'])->get();
        $academic_years = AcademicYear::with('semester')->orderBy('year', 'desc')->orderBy('semester_id', 'asc')->get();

        return Inertia::render('EditViolation',
        [
            'violation' => $transaction_violation,
            'violations' => $violations,
            'offense_levels' => $offense_levels,
            'penalty_actions' => $penalty_actions,
            'statuses' => $statuses,
            'students' => $students,
            'academic_years' => $academic_years,

        ]);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionViolation $transaction_violation)
    {
        $request->validate([
            'student_id' => ['required'],
            'violation_id' => ['required'],
        ]);

        $transaction_violation->transaction_number = 'VLN-'.Str::random(6);
        $transaction_violation->student_id = $request->student_id;
        $transaction_violation->academic_year_id = $request->academic_year_id;
        $transaction_violation->violation_id = $request->violation_id;
        $transaction_violation->offense_level_id = $request->offense_level_id;
        $transaction_violation->remarks = $request->remarks;
        $transaction_violation->update();

        return to_route('transaction_violation.index');
    }

    public function resolve(Request $request, TransactionViolation $transaction_violation)
    {

        $request->validate([
            'status_id' => ['required']
        ]);

        $transaction_violation->status_id = $request->status_id;
        $transaction_violation->penalty_action_id = $request->penalty_action_id;
        $transaction_violation->resolution = $request->resolution;
        $transaction_violation->update();

        return to_route('transaction_violation.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionViolation $transaction_violation)
    {
        $transaction_violation->delete();

        return to_route('transaction_violation.index');
    }
}
