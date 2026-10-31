<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'date' => 'required|date',
            'thumbnail' => 'required|image',
        ]);

        $data['image'] = $request->file('thumbnail')->store('assets/agenda', 'public');

        Agenda::create([
            'title' => $data['name'],
            'slug' => $this->uniqueSlug($data['name']),
            'description' => $data['description'],
            'location' => $data['address'],
            'date_start' => $data['date'],
            'image' => $data['image'],
        ]);
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

        $agenda = Agenda::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'date' => 'required|date',
            'thumbnail' => 'nullable|image',
        ]);

        $attributes = [
            'title' => $data['name'],
            'slug' => $this->uniqueSlug($data['name'], $agenda->id),
            'description' => $data['description'],
            'location' => $data['address'],
            'date_start' => $data['date'],
        ];

        if ($request->hasFile('thumbnail')) {
            $oldImage = $agenda->image;
            $attributes['image'] = $request->file('thumbnail')->store('assets/agenda', 'public');
        }

        $agenda->update($attributes);

        if (isset($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

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

        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'agenda';
        $slug = $baseSlug;
        $suffix = 2;

        while (Agenda::where('slug', $slug)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists()) {
            $slug = $baseSlug . '-' . $suffix++;
        }

        return $slug;
    }
}
