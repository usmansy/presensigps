<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        // $request->validate([
        //     'username' => ['required', 'unique:karyawan'],
        //     'nama_lengkap' => ['required'],
        //     'jabatan' => ['required'],
        //     'kode_dept' => ['required'],
        //     'no_hp' => ['required', 'numeric'],
        //     'password' => ['required'],
        // ], [
        //     'username.required' => 'Username harus diisi',
        //     'username.unique' => 'Username sudah ada',
        //     'nama_lengkap.required' => 'Nama Lengkap harus diisi',
        //     'jabatan.required' => 'Jabatan harus diisi',
        //     'kode_dept.required' => 'Kode Departemen harus diisi',
        //     'no_hp.required' => 'No. HP harus diisi',
        //     'no_hp.numeric' => 'No. HP harus berisi angka',
        //     'password.required' => 'Password harus diisi',
        // ]);

        $messages = [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah ada',
            'nik.required' => 'NIK/NIP harus diisi',
            'nik.numeric' => 'NIK/NIP harus berisi angka',
            'nama_lengkap.required' => 'Nama Lengkap harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'kode_dept.required' => 'Kode Departemen harus diisi',
            'no_hp.required' => 'No. HP harus diisi',
            'no_hp.numeric' => 'No. HP harus berisi angka',
            'password.required' => 'Password harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:karyawan',
            'nik' => 'required|numeric',
            'nama_lengkap' => 'required',
            'jabatan' => ['required'],
            'kode_dept' => ['required'],
            'no_hp' => ['required', 'numeric'],
            'password' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }
}
