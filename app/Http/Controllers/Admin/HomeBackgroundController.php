<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeBackgroundController extends Controller
{
    public function index()
    {
        $profile = Profiles::firstOrCreate(
            ['id' => 1],
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

        return view('pages.admin.home-background.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'home_background_1' => 'nullable|image|max:10240',
            'home_background_2' => 'nullable|image|max:10240',
            'home_background_3' => 'nullable|image|max:10240',
        ]);

        $profile = Profiles::findOrFail(1);

        foreach (['home_background_1', 'home_background_2', 'home_background_3'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('assets/home-backgrounds', 'public');
            } else {
                unset($data[$field]);
            }
        }

        $profile->update($data);

        Alert::success('Berhasil', 'Foto latar beranda berhasil diperbarui');
        return redirect()->route('home-background.index');
    }
}
