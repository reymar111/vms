<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use Illuminate\Http\Request;

class ViolationController extends Controller
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
            'code' => ['required'],
            'name' => ['required'],
            'category_id' => ['required'],
        ]);

        $violation = new Violation();
        $violation->code = $request->code;
        $violation->name = $request->name;
        $violation->description = $request->description;
        $violation->category_id = $request->category_id;
        $violation->penalty_id = $request->penalty_id;
        $violation->save();

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
        $violation->penalty_id = $request->penalty_id;
        $violation->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violation $violation)
    {
        $violation->delete();
    }
}
