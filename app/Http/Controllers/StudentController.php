<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Program;
use App\Models\Section;
use App\Models\Student;
use App\Models\YearLevel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['program', 'year_level', 'section'])->get();
        $programs = Program::all();
        $year_levels = YearLevel::all();
        $sections = Section::all();

        return Inertia::render('Settings/Student',
        [
            'students' => $students,
            'programs' => $programs,
            'year_levels' => $year_levels,
            'sections' => $sections,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_number' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'contact_number' => ['required'],
            'email_address' => ['required'],
            'program_id' => ['required'],
        ]);

        $student = new Student();
        $student->id_number = $request->id_number;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->ext_name = $request->ext_name;
        $student->address = $request->address;
        $student->contact_number = $request->contact_number;
        $student->email_address = $request->email_address;
        $student->program_id = $request->program_id;
        $student->year_level_id = $request->year_level_id;
        $student->section_id = $request->section_id;
        $student->save();

        return to_route('student.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'id_number' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'contact_number' => ['required'],
            'email_address' => ['required'],
            'program_id' => ['required'],
        ]);

        $student->id_number = $request->id_number;
        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;
        $student->ext_name = $request->ext_name;
        $student->address = $request->address;
        $student->contact_number = $request->contact_number;
        $student->email_address = $request->email_address;
        $student->program_id = $request->program_id;
        $student->year_level_id = $request->year_level_id;
        $student->section_id = $request->section_id;
        $student->update();

        return to_route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return to_route('student.index');
    }
}
