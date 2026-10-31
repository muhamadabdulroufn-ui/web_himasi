<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Divisi;
use App\Models\MemberDivisi;
use App\Models\News;
use App\Models\Proker;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {


        $prokerPending  = Proker::where('status', '=', 'belum_terlaksana')->count();
        $prokerProcess  = Proker::where('status', '=', 'proses')->count();
        $prokerSuccess  = Proker::where('status', '=', 'terlaksana')->count();

        $totalKegiatan  = Agenda::count();
        $divisi         = Divisi::count();
        $anggotaDivisi  = MemberDivisi::count();
        $user           = User::count();
        $news           = News::count();

        return view('pages.admin.dashboard', [
            'news'          => $news,
            'prokerPending' => $prokerPending,
            'prokerProcess' => $prokerProcess,
            'prokerSuccess' => $prokerSuccess,
            'totalKegiatan' => $totalKegiatan,
            'divisi'        => $divisi,
            'anggotaDivisi' => $anggotaDivisi,
            'user'          => $user,
        ]);
    }
}
