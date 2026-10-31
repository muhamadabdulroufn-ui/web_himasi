<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\MemberDivisi;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MemberDivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MemberDivisi::get();
        return view('pages.admin.member-divisi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisi = Divisi::get();
        $periode = Periode::get();
        return view('pages.admin.member-divisi.create', [
            'divisi' => $divisi,
            'periode' => $periode,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisies,id',
            'period_id' => 'required|exists:periods,id',
            'jabatan' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'foto' => 'required|image|max:5120',
        ]);

        $data['image'] = $request->file('foto')->store('assets/divisi', 'public');
        $data['position'] = $data['jabatan'];
        unset($data['foto'], $data['jabatan']);

        MemberDivisi::create($data);
        Alert::success('Berhasil', 'Data Baru Berhasil ditambahkan');
        return redirect()->route('member-divisi.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.admin.member-divisi.edit', [
            'data' => MemberDivisi::findOrFail($id),
            'divisi' => Divisi::get(),
            'periode' => Periode::get(),
        ]);
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

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisies,id',
            'period_id' => 'required|exists:periods,id',
            'jabatan' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'foto' => 'nullable|image|max:5120',
        ]);
        $memberDivisi = MemberDivisi::findOrFail($id);

        if ($request->file('foto')) {
            $data['image'] = $request->file('foto')->store('assets/divisi', 'public');
            Storage::disk('public')->delete($memberDivisi->image);
        }

        $data['position'] = $data['jabatan'];
        unset($data['foto'], $data['jabatan']);
        $memberDivisi->update($data);

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return redirect()->route('member-divisi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MemberDivisi::findOrFail($id);

        Storage::disk('public')->delete($data->image);

        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }
}
