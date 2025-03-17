<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\AcademicYear;
use App\Models\Semester;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academic_years = AcademicYear::with('semester')->get();
        $semesters = Semester::all();

        return Inertia::render('Settings/AcademicYear',
        [
            'academic_years' => $academic_years,
            'semesters' => $semesters,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => ['required'],
            'code' => ['required'],
            'semester_id' => ['required'],
        ]);

        $acad = new AcademicYear();
        $acad->year = $request->year;
        $acad->code = $request->code;
        $acad->description = $request->description;
        $acad->semester_id = $request->semester_id;
        $acad->save();

        return to_route('academic_year.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicYear $academic_year)
    {
        $request->validate([
            'year' => ['required'],
            'code' => ['required'],
            'semester_id' => ['required'],
        ]);

        $academic_year->year = $request->year;
        $academic_year->code = $request->code;
        $academic_year->description = $request->description;
        $academic_year->semester_id = $request->semester_id;
        $academic_year->update();

        return to_route('academic_year.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academic_year)
    {
        $academic_year->delete();

        return to_route('academic_year.index');
    }
}
