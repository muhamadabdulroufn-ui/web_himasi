<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'DESC')->take(3)->get();
        $agenda = Agenda::orderBy('created_at', 'DESC')->take(3)->get();

        return view('home', [
            'news' => $news,
            'agenda' => $agenda,
        ]);
    }
}
