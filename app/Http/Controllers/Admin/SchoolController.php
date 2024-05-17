<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get schools
        $schools = School::when(request()->q, function($schools) {
            $schools = $schools->where('title', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $schools->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Admin/Schools/Index', [
            'schools' => $schools,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Schools/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'title' => 'required|string|unique:schools',
        ]);

        //create school
        School::create([
            'title' => $request->title,
        ]);

        //redirect
        return redirect()->route('admin.schools.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get school
        $school = School::findOrFail($id);

        //render with inertia
        return inertia('Admin/Schools/Edit', [
            'school' => $school,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        //validate request
        $request->validate([
            'title' => 'required|string|unique:schools,title,'.$school->id,
        ]);

        //update school
        $school->update([
            'title' => $request->title,
        ]);

        //redirect
        return redirect()->route('admin.schools.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get school
        $school = School::findOrFail($id);

        //delete school
        $school->delete();

        //redirect
        return redirect()->route('admin.schools.index');
    }
}
