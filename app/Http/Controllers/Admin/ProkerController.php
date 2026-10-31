<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Proker;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProkerController extends Controller
{
    public function __construct()
    {
        // dd(Auth::user());
        // $this->middleware(['auth', 'checkRole:pembina'])->only(['index']);
        // $this->middleware(['auth', 'checkRole:admin']);
        // $this->middleware('checkRole:admin')->only(['index', 'update', 'edit', 'create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Proker::get();
        return view('pages.admin.proker.index', compact('data'));
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
        return view('pages.admin.proker.create', [
            'divisi' => $divisi,
            'periode' => $periode
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
            'date' => 'required|date',
            'divisi_id' => 'required|exists:divisies,id',
            'status' => 'required|in:belum_terlaksana,proses,terlaksana',
            'periode_id' => 'required|exists:periods,id',
            'proposal' => 'nullable|file|max:10240',
            'lpj' => 'nullable|file|max:10240',
            'link_documentation' => 'nullable|url|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->file('proposal')) {
            $data['proposal'] = $request->file('proposal')->store('assets/proker', 'public');
        }

        if ($request->file('lpj')) {
            $data['lpj'] = $request->file('lpj')->store('assets/proker', 'public');
        }

        $data['slug'] = $this->uniqueSlug($data['name']);
        if (Schema::hasColumn('prokers', 'title')) {
            $data['title'] = $data['name'];
        }
        if (Schema::hasColumn('prokers', 'period_id')) {
            $data['period_id'] = $data['periode_id'];
        }
        $data['status'] = $this->databaseStatus($data['status']);

        Proker::create($data);
        Alert::success('Berhasil', 'Data Baru Berhasil ditambahkan');
        return redirect()->route('program-kerja.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Proker::with('comment')->findOrFail($id);

        return view('pages.admin.proker.detail', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.admin.proker.edit', [
            'data' => Proker::findOrFail($id),
            'divisi' =>  Divisi::get(),
            'periode' => Periode::get()
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
            'divisi_id' => 'required|exists:divisies,id',
            'status' => 'required|in:belum_terlaksana,proses,terlaksana',
            'periode_id' => 'required|exists:periods,id',
            'proposal' => 'nullable|file|max:10240',
            'lpj' => 'nullable|file|max:10240',
            'link_documentation' => 'nullable|url|max:2048',
            'description' => 'nullable|string',
        ]);

        $book = Proker::findOrFail($id);

        if ($request->file('proposal')) {
            $data['proposal'] = $request->file('proposal')->store('assets/proker', 'public');
            Storage::disk('public')->delete($book->proposal);
        }

        if ($request->file('lpj')) {
            $data['lpj'] = $request->file('lpj')->store('assets/proker', 'public');
            Storage::disk('public')->delete($book->lpj);
        }

        $data['slug'] = $this->uniqueSlug($data['name'], $book->id);
        if (Schema::hasColumn('prokers', 'title')) {
            $data['title'] = $data['name'];
        }
        if (Schema::hasColumn('prokers', 'period_id')) {
            $data['period_id'] = $data['periode_id'];
        }
        $data['status'] = $this->databaseStatus($data['status']);

        $book->update($data);

        Alert::success('Berhasil', 'Data Berhasil diperbarui');
        return redirect()->route('program-kerja.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Proker::findOrFail($id);

        Storage::disk('public')->delete($data->proposal);
        Storage::disk('public')->delete($data->lpj);
        $data->delete();

        Alert::success('Berhasil', 'Data Berhasil dihapus');
        return back();
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'program-kerja';
        $slug = $baseSlug;
        $suffix = 2;

        while (Proker::where('slug', $slug)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists()) {
            $slug = $baseSlug . '-' . $suffix++;
        }

        return $slug;
    }

    private function databaseStatus(string $status): string
    {
        if (!Schema::hasColumn('prokers', 'status')) {
            return $status;
        }

        $column = DB::selectOne("SHOW COLUMNS FROM prokers LIKE 'status'");
        if (!$column || strpos($column->Type, "enum('Plan'") !== 0) {
            return $status;
        }

        return [
            'belum_terlaksana' => 'Plan',
            'proses' => 'On Progress',
            'terlaksana' => 'Done',
        ][$status];
    }
}
