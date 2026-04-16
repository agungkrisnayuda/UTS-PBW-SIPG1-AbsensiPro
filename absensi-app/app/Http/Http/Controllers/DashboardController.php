<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    // admin
    if (Auth::user()->role == 'admin') {

        $totalUser = \App\Models\User::count();
        $totalAbsensi = \App\Models\Absensi::count();
        $absensiHariIni = \App\Models\Absensi::where('tanggal', date('Y-m-d'))->count();

        $chartTanggal = [];
        $chartJumlah = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = date('Y-m-d', strtotime("-$i days"));

            $jumlah = \App\Models\Absensi::where('tanggal', $tanggal)->count();

            $chartTanggal[] = $tanggal;
            $chartJumlah[] = $jumlah;
        }

        // user terbaru
        $userTerbaru = \App\Models\User::latest()->take(5)->get();

        // baru return
        return view('dashboard.admin', compact(
            'totalUser',
            'totalAbsensi',
            'absensiHariIni',
            'chartTanggal',
            'chartJumlah',
            'userTerbaru'
        ));
    }

    // user biasa
    $data = \App\Models\Absensi::where('user_id', Auth::id())->get();

    return view('dashboard.user', compact('data'));


    // user biasa
    $data = \App\Models\Absensi::where('user_id', Auth::id())->get();

    return view('dashboard.user', compact('data'));
}
}
