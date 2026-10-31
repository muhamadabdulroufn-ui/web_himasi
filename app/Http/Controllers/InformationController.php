<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Divisi;
use App\Models\Gallery;
use App\Models\MemberDivisi;
use App\Models\News;
use App\Models\Proker;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function tentang()
    {
        return view('pages.front.tentang');
    }

    public function divisi()
    {
        $divisi = MemberDivisi::get();

        return view('pages.front.divisi', [
            'divisi' => $divisi
        ]);
    }

    public function proker()
    {
        $proker = Proker::get();

        return view('pages.front.proker', [
            'proker' => $proker
        ]);
    }

    public function indexNews()
    {
        $news = News::orderBy('created_at', 'DESC')->get();

        return view('pages.front.news.index', [
            'news' => $news
        ]);
    }

    public function showNews($slug)
    {
        $news = News::where('slug', '=', $slug)->first();

        return view('pages.front.news.show', [
            'news' => $news
        ]);
    }

    public function gallery()
    {
        $galleries = Gallery::get();

        return view('pages.front.gallery.gallery', [
            'galleries' => $galleries
        ]);
    }

    public function galleryDetail($id)
    {
        $galleries = Gallery::find($id);

        return view('pages.front.gallery.detail', [
            'galleries' => $galleries
        ]);
    }

    public function agenda()
    {
        $agenda = Agenda::orderBy('created_at', 'DESC')->get();

        return view('pages.front.agenda', [
            'agenda' => $agenda
        ]);
    }

    public function agendaShow(Request $request)
    {
        $id = $request->id;
        $agendaDetail = Agenda::where('id', '=', $id)->first();

        return view('home', [
            'agendaDetail' => $agendaDetail
        ]);
    }

    public function contact()
    {
        return view('pages.front.contact');
    }
}
