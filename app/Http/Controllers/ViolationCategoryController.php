<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ViolationCategory;

class ViolationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $violation_categories = ViolationCategory::all();

        return Inertia::render('Settings/ViolationCategory',
        [
            'violation_categories' => $violation_categories,
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

        $violation_category = new ViolationCategory();
        $violation_category->name = $request->name;
        $violation_category->save();

        return to_route('violation_category.index');

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

        return to_route('violation_category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ViolationCategory $violation_category)
    {
        $violation_category->delete();

        return to_route('violation_category.index');
    }
}
