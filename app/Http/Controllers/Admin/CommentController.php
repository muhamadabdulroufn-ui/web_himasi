<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proker;
use App\Models\ProkerComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:5000',
        ]);

        $data['proker_id'] = Proker::findOrFail($request->route('id'))->id;
        $data['user_id'] = Auth::id();

        ProkerComment::create($data);
        Alert::success('Berhasil', 'Komentar berhasil ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $data = $request->validate([
            'comment' => 'required|string|max:5000',
        ]);

        $book = ProkerComment::findOrFail($id);

        $book->update($data);

        Alert::success('Berhasil', 'Komentar berhasil diperbarui');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = ProkerComment::findOrFail($id);

        $data->delete();

        Alert::success('Berhasil', 'Komentar berhasil dihapus');
        return redirect()->back();
    }
}
