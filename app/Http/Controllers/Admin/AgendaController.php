<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Agenda::get();

        $results = [];

        $results['categories'] = $data->pluck('agenda_name');

        $results['series'] = $data->pluck('total');

        return view('pages.admin.agenda.index', [
            'data' => $data,
            'chart' => json_encode($results)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->file('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store(
                'assets/agenda',
                'public'
            );
        }

        Agenda::create($data);
        Alert::success('Berhasil', 'Data Baru Berhasil ditambahkan');
        return redirect()->route('agenda.index');
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
        return view('pages.admin.agenda.edit', [
            'data' => Agenda::findOrFail($id)
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

        $data = $request->all();

        $agenda = Agenda::findOrFail($id);

        if ($request->file('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store(
                'assets/agenda',
                'public'
            );
        }

        $agenda->update($data);

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return redirect()->route('agenda.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Agenda::findOrFail($id);

        Storage::disk('public')->delete($data->thumbnail);

        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }
}
