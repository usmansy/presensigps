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
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $username = Auth::guard('karyawan')->user()->username;
        $dataprofile = DB::table('karyawan')->where('username', $username)->first();
        $presensihariini = Presensi::where('username', $username)->where('tgl_presensi', $hariini)->first();
        $historybulanini = DB::table('presensi')
            ->where('username', $username)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi')
            ->get();

        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(username) as jmlhadir, SUM(IF(jam_in > "07:30",1,0)) as jmlterlambat')
            ->where('username', $username)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();

        $leaderboard = DB::table('presensi')
            ->join('karyawan', 'presensi.username', '=', 'karyawan.username')
            ->where('tgl_presensi', $hariini)
            ->orderBy('jam_in')
            ->get();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('dashboard.dashboard', compact('presensihariini', 'historybulanini', 'namabulan', 'bulanini', 'tahunini', 'rekappresensi', 'leaderboard', 'dataprofile'));
    }
}
