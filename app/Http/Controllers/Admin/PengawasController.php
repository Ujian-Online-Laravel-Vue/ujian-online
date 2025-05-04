<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamSession;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PengawasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //get users with 'pengawas' role
        $users = User::role('pengawas')->when(request()->q, function($users) {
            $users = $users->where('name', 'like', '%'. request()->q . '%');
        })->with('school', 'exam_sessions')->latest()->paginate(5);

        //append query string to pagination links
        $users->appends(['q' => request()->q]);

        //render with inertia
        return Inertia::render('Admin/Pengawas/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        //get schools
        $schools = School::all();

        //get exam_sessions
        $exam_sessions = ExamSession::all();

        //render with inertia
        return Inertia::render('Admin/Pengawas/Create', [
            'schools' => $schools,
            'exam_sessions' => $exam_sessions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
            'school_id' => 'nullable'
        ]);

        //create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id
        ]);

        //assign 'pengawas' role
        $user->assignRole('pengawas');

        //redirect
        return redirect()->route('admin.pengawas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        //get user by id
        $user = User::findOrFail($id);

        //render with inertia
        return Inertia::render('Admin/Pengawas/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {

        //get schools
        $schools = School::all();

        //get exam_sessions
        $exam_sessions = ExamSession::all();

        //get user by id
        $user = User::findOrFail($id);

        //render with inertia
        return Inertia::render('Admin/Pengawas/Edit', [
            'user' => $user,
            'schools' => $schools,
            'exam_sessions' => $exam_sessions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'password' => 'string|confirmed|nullable',
            'school_id' => 'nullable'
        ]);

        //get user by id
        $user = User::findOrFail($id);

        //update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'school_id' => $request->school_id
        ]);

        //redirect
        return redirect()->route('admin.pengawas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //get user by id
        $user = User::findOrFail($id);

        //delete user
        $user->delete();

        //redirect
        return redirect()->route('admin.pengawas.index');
    }
}
