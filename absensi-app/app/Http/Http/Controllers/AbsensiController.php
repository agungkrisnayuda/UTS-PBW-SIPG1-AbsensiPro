<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
public function index(Request $request)
{
    $query = \App\Models\Absensi::query();

    if (Auth::user()->role != 'admin') {
        $query->where('user_id', Auth::id());
    }

    if ($request->tanggal) {
        $query->where('tanggal', $request->tanggal);
    }

    $data = $query->get();

    return view('absensi.index', compact('data'));
}

    public function masuk()
    {
        // cek apakah sudah absen hari ini
        $cek = Absensi::where('user_id', Auth::id())
            ->where('tanggal', date('Y-m-d'))
            ->first();

        if ($cek) {
            return back()->with('error', 'Kamu sudah absen hari ini!');
        }

        Absensi::create([
            'user_id' => Auth::id(),
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => date('H:i:s')
        ]);

        return back()->with('success', 'Absen masuk berhasil');
    }

    public function keluar($id)
    {
        $absen = Absensi::find($id);

        $absen->update([
            'jam_keluar' => date('H:i:s')
        ]);

        return back()->with('success', 'Absen keluar berhasil');
    }
}