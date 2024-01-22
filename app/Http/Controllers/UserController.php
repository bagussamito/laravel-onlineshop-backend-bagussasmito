<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Index
    public function index(Request $request)
    {
        // Get Users With Pagination
        $users = DB::table('users')
            -> when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->search}%");
            })
            -> paginate(5);
        return view('pages.user.index', compact ('users'));
    }

    // Create
    public function create()
    {
        return view('pages.user.create');
    }

    // Store
    public function store(Request $request)
    {
        $data = $request->all();
        $data['passowrd'] = Hash::make($request->input('password'));
        User::create($data);
        return redirect()->route('user.index');
    }


    //edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        //check if password is not empty
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            //if password is empty, then use the old password
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('user.index');
    }

    // Destory
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
