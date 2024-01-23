<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date("Y-m-d");
        $username = Auth::guard('karyawan')->user()->username;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('username', $username)->count();
        return view('presensi.create', compact('cek'));
    }

    public function store(Request $request)
    {
        $username = Auth::guard('karyawan')->user()->username;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lokasi = $request->lokasi;
        $image = $request->image;

        $folderPath = "upload/image/presensi/";
        $formatName = $username . "-" . $tgl_presensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";


        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('username', $username)->count();
        if ($cek > 0) {
            $dataPulang = [
                'jam_out' => $jam,
                'foto_out' => $fileName,
                'location_out' => $lokasi,
            ];
            $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('username', $username)->update($dataPulang);
            if ($update) {
                echo "success|Berhasil, Hati-hati di jalan|out";
                file_put_contents($folderPath . $fileName, $image_base64);
            } else {
                echo "error|Maaf gagal presensi, Hubungi admin|out";
            }
        } else {
            $dataMasuk = [
                'username' => $username,
                'tgl_presensi' => $tgl_presensi,
                'jam_in' => $jam,
                'foto_in' => $fileName,
                'location_in' => $lokasi,
            ];
            $simpan = DB::table('presensi')->insert($dataMasuk);
            if ($simpan) {
                echo "success|Berhasil, Selamat bekerja|in";
                file_put_contents($folderPath . $fileName, $image_base64);
            } else {
                echo "error|Maaf gagal presensi, Hubungi admin|in";
            }
        }
    }
}
