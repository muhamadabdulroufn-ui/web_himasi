<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailGallery;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DetailGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = Gallery::find($id);
        return view('pages.admin.gallery.detail.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = Gallery::find($id);
        return view('pages.admin.gallery.detail.create', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $data = $request->all();

        $data['galeri_id'] = $id;

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/galeri',
                'public'
            );
        }


        DetailGallery::create($data);
        Alert::success('Berhasil', 'Data Baru Berhasil ditambahkan');
        return redirect('admin/detail-galeri/' . $id);
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
    public function edit($id, $galeri_id)
    {
        return view('pages.admin.gallery.detail.edit', [
            'data' => Gallery::findOrFail($id),
            'image' => DetailGallery::findOrFail($galeri_id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $image_id)
    {

        $data = $request->all();

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store(
                'assets/galeri',
                'public'
            );
        }

        $image = DetailGallery::findOrFail($image_id);

        $image->update($data);

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return redirect('admin/detail-galeri/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $image_id)
    {
        $data = DetailGallery::findOrFail($image_id);

        Storage::disk('public')->delete($data->image);
        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }
}
