<?php

namespace App\Http\Controllers;

use App\Models\ViolationCategory;
use Illuminate\Http\Request;

class ViolationCategoryController extends Controller
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

        $violation_category = new ViolationCategory();
        $violation_category->name = $request->name;
        $violation_category->save();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ViolationCategory $violation_category)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $violation_category->name = $request->name;
        $violation_category->update();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ViolationCategory $violation_category)
    {
        $violation_category->delete();
    }
}
