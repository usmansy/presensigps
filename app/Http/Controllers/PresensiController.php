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
        $latitudekantor = -7.673815637589477;
        $longitudekantor = 108.67975559751909;
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('username', $username)->count();
        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }
        $image = $request->image;

        $folderPath = "upload/image/presensi/";
        $formatName = $username . "-" . $tgl_presensi . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";


        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('username', $username)->count();
        if ($radius > 100) {
            echo "error|Maaf anda berada di luar radius kantor, jarak anda " . $radius . " meter dari kantor|";
        } else {

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

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}
