<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\News;
use App\Models\Profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $profile = Profiles::find(1);
        $heroBackgrounds = [];

        foreach ([1, 2, 3] as $number) {
            $field = 'home_background_' . $number;
            $heroBackgrounds[] = $profile && $profile->$field
                ? Storage::disk('public')->url($profile->$field)
                : asset('assets/img/bg-banner' . ($number === 1 ? '' : $number) . '.jpg');
        }

        return view('home', [
            'news' => $news,
            'agenda' => $agenda,
            'heroBackgrounds' => $heroBackgrounds,
        ]);
    }
}
