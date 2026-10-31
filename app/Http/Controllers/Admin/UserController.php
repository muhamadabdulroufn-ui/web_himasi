<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('pages.admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        Alert::success('Berhasil', 'Data Baru Berhasil ditambahkan');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        return view('pages.admin.users.edit', [
            'data' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {

        $users = User::findOrFail($id);

        $users->name = $request->name;
        $users->email = $request->email;
        if ($request->password)
            $users->password = Hash::make($request->password);
        $users->role = $request->role;

        $users->update();

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }
}
