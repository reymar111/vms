<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Violation;
use Illuminate\Http\Request;
use App\Models\ViolationCategory;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $violations = Violation::with('category')->get();
        $violation_categories = ViolationCategory::all();

        return Inertia::render('Settings/Violation',
        [
            'violations' => $violations,
            'violation_categories' => $violation_categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'category_id' => ['required'],
        ]);

        $violation = new Violation();
        $violation->code = $request->code;
        $violation->name = $request->name;
        $violation->description = $request->description;
        $violation->category_id = $request->category_id;
        $violation->save();

        return to_route('violation.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Violation $violation)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
            'category_id' => ['required'],
        ]);

        $violation->code = $request->code;
        $violation->name = $request->name;
        $violation->description = $request->description;
        $violation->category_id = $request->category_id;
        $violation->update();

        return to_route('violation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violation $violation)
    {
        $violation->delete();

        return to_route('violation.index');
    }
}
