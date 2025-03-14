<?php

namespace App\Http\Controllers;

use App\Models\College;
use Inertia\Inertia;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with('college')->get();
        $colleges = College::all();

        return Inertia::render('Settings/Program',
        [
            'colleges' => $colleges,
            'programs' => $programs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'college_id' => ['required'],
            'code' => ['required'],
            'description' => ['required'],
        ]);

        $program = new Program();
        $program->college_id = $request->college_id;
        $program->code = $request->code;
        $program->description = $request->description;
        $program->save();

        return to_route('program.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'college_id' => ['required'],
            'code' => ['required'],
            'description' => ['required'],
        ]);
        $program->college_id = $request->college_id;
        $program->code = $request->code;
        $program->description = $request->description;
        $program->update();

        return to_route('program.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return to_route('program.index');
    }
}
