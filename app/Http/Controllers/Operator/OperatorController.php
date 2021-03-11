<?php

namespace App\Http\Controllers\Operator;

use App\Models\User;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    //
    public function index()
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.index');
    }

    public function showOperators()
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $datas = Operator::paginate(10);

        return view('operator.admin.operator.index', compact('datas'));
    }

    public function showOperator(Operator $operator)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        return view('operator.admin.operator.show', compact('operator'));
    }

    public function registerOperator()
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $roles = [1 => 'Administrator', 2 => 'Petugas'];

        return view('operator.admin.operator.create', compact('roles'));
    }

    public function storeOperator(Request $request)
    {
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

    public function editOperator(User $user)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

        $roles = [1 => 'Administrator', 2 => 'Petugas'];

        return view('operator.admin.operator.edit', compact('roles', 'user'));
    }

    public function updateOperator(Request $request, User $user)
    {
        $user->role_id = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'lol');
    }

    public function destroy(User $user)
    {
        if (Gate::allows('masyarakat') || Gate::allows('petugas')) {
            abort(403);
        }

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

    public function showItem()
    {
        if (Gate::allows('masyarakat')) {
            abort(403);
        }

        return view('operator.index');
    }
}
