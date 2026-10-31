<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        Comment::create($data);
        Alert::success('Berhasil', 'Komentar berhasil ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();

        $book = Comment::findOrFail($id);

        $book->update($data);

        Alert::success('Berhasil', 'Komentar berhasil diperbarui');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = Comment::findOrFail($id);

        $data->delete();

        Alert::success('Berhasil', 'Komentar berhasil dihapus');
        return redirect()->back();
    }
}
