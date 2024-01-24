<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m");
        $tahunini = date("Y");
        $username = Auth::guard('karyawan')->user()->username;
        $presensihariini = Presensi::where('username', $username)->where('tgl_presensi', $hariini)->first();
        $historybulanini = DB::table('presensi')->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi')
            ->get();
        return view('dashboard.dashboard', compact('presensihariini', 'historybulanini'));
    }
}
