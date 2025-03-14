<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colleges = College::all();

        return Inertia::render('Settings/College',
        [
            'colleges' => $colleges,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'description' => ['required'],
        ]);

        $college = new College();
        $college->code = $request->code;
        $college->description = $request->description;
        $college->save();

        return to_route('college.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, College $college)
    {
        $request->validate([
            'code' => ['required'],
            'description' => ['required'],
        ]);

        $college->code = $request->code;
        $college->description = $request->description;
        $college->update();

        return to_route('college.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        $college->delete();

        return to_route('college.index');
    }
}
