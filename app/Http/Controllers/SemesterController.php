<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::all();

        return Inertia::render('Settings/Semester',
        [
            'semesters' => $semesters,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $semester = new Semester();
        $semester->name = $request->name;
        $semester->save();

        return to_route('semester.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $semester->name = $request->name;
        $semester->update();

        return to_route('semester.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();

        return to_route('semester.index');
    }
}
