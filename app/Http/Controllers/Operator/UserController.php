<?php

namespace App\Http\Controllers\Operator;

use App\Models\User;
use App\Models\People;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $datas = Operator::paginate(10);

        return view('operator.admin.operator.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $roles = [1 => 'Administrator', 2 => 'Petugas'];

        return view('operator.admin.operator.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role
        ]);

        Operator::create([
            'user_id' => $user->id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $operator = Operator::findOrFail($id);

        return view('operator.admin.operator.show', compact('operator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $user = User::findOrFail($id);

        $roles = [1 => 'Administrator', 2 => 'Petugas'];

        return view('operator.admin.operator.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $user->role_id = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'lol');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }
        
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'lol');
    }

    public function showPeoples()
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $datas = People::paginate(10);
        return view('operator.admin.people.index', compact('datas'));
    }

    public function showPeople(People $people)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        return view('operator.admin.people.show', compact('people'));
    }
}
