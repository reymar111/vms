<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\PenaltyAction;

class PenaltyActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penalty_actions = PenaltyAction::all();

        return Inertia::render('Settings/PenaltyAction',
        [
            'penalty_actions' => $penalty_actions,
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

        $action = new PenaltyAction();
        $action->name = $request->name;
        $action->save();

        return to_route('penalty_action.index');

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

        return to_route('penalty_action.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenaltyAction $penalty_action)
    {
        $penalty_action->delete();

        return to_route('penalty_action.index');
    }
}
