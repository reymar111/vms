<?php

namespace App\Http\Controllers;

use App\Models\PenaltyAction;
use Illuminate\Http\Request;

class PenaltyActionController extends Controller
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

        $action = new PenaltyAction();
        $action->name = $request->name;
        $action->save();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenaltyAction $penalty_action)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $penalty_action->name = $request->name;
        $penalty_action->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenaltyAction $penalty_action)
    {
        $penalty_action->delete();
    }
}
