<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $header_title = 'Data Pegawai';

        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_dept');
        $query->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if (!empty($request->nama_karyawan)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }
        if (!empty($request->kode_dept)) {
            $query->where('karyawan.kode_dept', $request->kode_dept);
        }
        $karyawan = $query->paginate(2);

        $departemen = DB::table('departemen')->get();
        return view('karyawan.index', compact('header_title', 'karyawan', 'departemen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required','unique:username'],
        ],[
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah ada',
        ]);
    }
}
