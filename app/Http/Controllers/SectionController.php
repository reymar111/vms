<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();

        return Inertia::render('Settings/Section',
        [
            'sections' => $sections,
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

        $section = new Section();
        $section->name = $request->name;
        $section->save();

        return to_route('section.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $section->name = $request->name;
        $section->update();

        return to_route('section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return to_route('section.index');
    }
}
