<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\YearLevel;
use Illuminate\Http\Request;

class YearLevelController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $year_levels = YearLevel::all();

        return Inertia::render('Settings/YearLevel',
        [
            'year_levels' => $year_levels,
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

        $year_level = new YearLevel();
        $year_level->name = $request->name;
        $year_level->save();

        return to_route('year_level.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, YearLevel $year_level)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $year_level->name = $request->name;
        $year_level->update();

        return to_route('year_level.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YearLevel $year_level)
    {
        $year_level->delete();

        return to_route('year_level.index');
    }
}
