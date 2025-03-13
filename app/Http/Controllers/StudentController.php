<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $student->save();

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
        $student->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
    }
}
