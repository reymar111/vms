<?php

namespace App\Http\Controllers;

use App\Models\OffenseLevel;
use Illuminate\Http\Request;

class OffenseLevelController extends Controller
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
            'name' => ['required']
        ]);

        $offense_level = new OffenseLevel();
        $offense_level->name = $request->name;
        $offense_level->save();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OffenseLevel $offense_level)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $offense_level->name = $request->name;
        $offense_level->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffenseLevel $offense_level)
    {
        $offense_level->delete();
    }
}
