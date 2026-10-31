<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = News::get();
        return view('pages.admin.news.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = NewsCategory::get();
        return view('pages.admin.news.create', compact('category'));
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:news_categories,id',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        News::create([
            'title' => $data['title'],
            'slug' => $this->uniqueSlug($data['title']),
            'category_id' => $data['category_id'],
            'content' => $data['description'],
            'image' => $request->file('image')->store('assets/news', 'public'),
            'user_id' => Auth::id(),
        ]);
        Alert::success('Berhasil', 'Data Baru Berhasil ditambahkan');
        return redirect()->route('berita.index');
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

        return view('pages.admin.news.edit', [
            'data' => News::findOrFail($id),
            'category' => NewsCategory::get()
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:news_categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);
        $news = News::findOrFail($id);

        $attributes = [
            'title' => $data['title'],
            'slug' => $this->uniqueSlug($data['title'], $news->id),
            'category_id' => $data['category_id'],
            'content' => $data['description'],
        ];

        if ($request->hasFile('image')) {
            $oldImage = $news->image;
            $attributes['image'] = $request->file('image')->store('assets/news', 'public');
        }

        $news->update($attributes);

        if (isset($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return redirect()->route('berita.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = News::findOrFail($id);

        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'artikel';
        $slug = $baseSlug;
        $suffix = 2;

        while (News::where('slug', $slug)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists()) {
            $slug = $baseSlug . '-' . $suffix++;
        }

        return $slug;
    }
}
