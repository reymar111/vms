<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
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
            'description' => ['required'],
        ]);

        $college = new College();
        $college->code = $request->code;
        $college->description = $request->description;
        $college->save();

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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        $college->delete();
    }
}
