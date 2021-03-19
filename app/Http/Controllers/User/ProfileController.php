<?php

namespace App\Http\Controllers\User;

use App\Models\Bid;
use App\Models\User;
use App\Models\People;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function index()
    {
        $data = null;
        $bidCount = 0;
        if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2) {
            $data = Operator::findOrFail(Auth::user()->operators[0]->id);
        } else {
            $data = People::findOrFail(Auth::user()->people[0]->id);
        }
        $genders = ['L' => 'Laki - Laki', 'P' => 'Perempuan'];

        if (Auth::user()->role_id == 3) {
            $bidCount = Bid::where('people_id', Auth::user()->people[0]->id)->count();
        }

        return view('user.profile', compact('data', 'genders', 'bidCount'));
    }

    public function edit()
    {
        $data = null;
        if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2) {
            $data = Operator::findOrFail(Auth::user()->operators[0]->id);
        } else {
            $data = People::findOrFail(Auth::user()->people[0]->id);
        }
        $genders = ['L' => 'Laki - Laki', 'P' => 'Perempuan'];
        return view('user.edit-profile', compact('data', 'genders'));
    }

    public function update(Request $request, $userid, $profileid)
    {
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required|date',
            'phone' => 'max:12|unique:people,phone,' . $profileid . '|unique:operators,phone,' . $profileid,
        ]);
   
        $user = User::findOrFail($userid);
        if ($user->role_id === 1 || $user->role_id === 2) {
            Operator::where('id', $profileid)->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone' => $request->phone
            ]);

            $user->name = $request->name;
            $user->save();

            $temporaryfile = TemporaryFile::where('folder', $request->pic)->first();
            if ($temporaryfile) {
                $user->addMedia(storage_path('app/public/image/tmp/' . $request->pic . '/' . $temporaryfile->filename))
                ->toMediaCollection('avatar');
                
                rmdir(storage_path('app/public/image/tmp/' . $request->pic));
                $temporaryfile->delete();
            }
        } else {
            People::where('id', $profileid)->update([
                'name' => $request->name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'address' => $request->address,
                'phone' => $request->phone
            ]);

            $user->name = $request->name;
            $user->save();

            $temporaryfile = TemporaryFile::where('folder', $request->pic)->first();
            if ($temporaryfile) {
                $user->addMedia(storage_path('app/public/image/tmp/' . $request->pic . '/' . $temporaryfile->filename))
                ->toMediaCollection('avatar');
                rmdir(storage_path('app/public/image/tmp/' . $request->pic));
                $temporaryfile->delete();
            }
        }
        
        return redirect(route('profile'))->with('success', 'lol');
    }
}
