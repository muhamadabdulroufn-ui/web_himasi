<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gallery::get();
        return view('pages.admin.gallery.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.gallery.create');
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
            'date' => 'required|date',
            'thumbnail' => 'required|image',
        ]);

        Gallery::create([
            'title' => $data['name'],
            'slug' => $this->uniqueSlug($data['name']),
            'date' => $data['date'],
            'cover' => $request->file('thumbnail')->store('assets/galeri', 'public'),
        ]);
        Alert::success('Berhasil', 'Data Baru Berhasil ditambahkan');
        return redirect()->route('galeri.index');
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
        return view('pages.admin.gallery.edit', [
            'data' => Gallery::findOrFail($id)
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
            'date' => 'required|date',
            'thumbnail' => 'nullable|image',
        ]);
        $gallery = Gallery::findOrFail($id);

        $attributes = [
            'title' => $data['name'],
            'slug' => $this->uniqueSlug($data['name'], $gallery->id),
            'date' => $data['date'],
        ];

        if ($request->hasFile('thumbnail')) {
            $oldImage = $gallery->cover;
            $attributes['cover'] = $request->file('thumbnail')->store('assets/galeri', 'public');
        }

        $gallery->update($attributes);

        if (isset($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return redirect()->route('galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Gallery::findOrFail($id);

        if ($data->cover) {
            Storage::disk('public')->delete($data->cover);
        }

        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'galeri';
        $slug = $baseSlug;
        $suffix = 2;

        while (Gallery::where('slug', $slug)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists()) {
            $slug = $baseSlug . '-' . $suffix++;
        }

        return $slug;
    }
}
