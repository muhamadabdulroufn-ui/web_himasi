<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilesController extends Controller
{
    public function index($id)
    {
        $data = Profiles::firstOrCreate(
            ['id' => $id],
            [
                'name' => 'HIMASI UNUSA',
                'description' => '',
                'address' => '',
                'address_link' => '',
                'telpon' => '',
                'email' => '',
                'logo' => null,
                'vision' => '',
                'mission' => '',
                'organization' => null,
                'filosofi_logo' => null,
            ]
        );

        return view('pages.admin.profile.index', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'telpon' => 'required|string|max:50',
            'address' => 'required|string',
            'address_link' => 'required|string',
            'email' => 'required|email|max:255',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'description' => 'required|string',
            'logo' => 'nullable|image|max:5120',
            'organization' => 'nullable|image|max:5120',
            'filosofi_logo' => 'nullable|image|max:5120',
        ]);

        if ($request->file('logo')) {
            $data['logo'] = $request->file('logo')->store(
                'assets/profile',
                'public'
            );
        }

        if ($request->file('organization')) {
            $data['organization'] = $request->file('organization')->store(
                'assets/profile',
                'public'
            );
        }

        if ($request->file('filosofi_logo')) {
            $data['filosofi_logo'] = $request->file('filosofi_logo')->store(
                'assets/profile',
                'public'
            );
        }

        $profile = Profiles::findOrFail($id);
        $profile->update($data);

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return back();
    }
}
