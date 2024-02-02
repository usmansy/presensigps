<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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
        $karyawan = $query->paginate(5);

        $departemen = DB::table('departemen')->get();
        return view('karyawan.index', compact('header_title', 'karyawan', 'departemen'));
    }

    public function store(Request $request)
    {
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
            'foto.max' => 'Ukuran file tidak boleh lebih dari 1MB',
        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:karyawan',
            'nik' => 'required|numeric',
            'nama_lengkap' => 'required',
            'jabatan' => ['required'],
            'kode_dept' => ['required'],
            'no_hp' => ['required', 'numeric'],
            'password' => ['required'],
            'foto' => 'max:1024',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // $request->foto->move(public_path('upload/image/karyawan'), $imageName);

        //Resize gmabar
        if ($request->file('foto')) {
            $manager = new ImageManager(new Driver());
            $image = $request->file('foto');
            $imageName = $request->username . '.' . $image->getClientOriginalExtension();;

            $img = $manager->read($request->file('foto'));
            $img = $img->cover(300, 300);
            $img->toJpeg(80)->save(base_path('public/upload/image/karyawan/' . $imageName));

            //Simpan data
            $data = new Karyawan();
            $data->username = $request->username;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->nik = $request->nik;
            $data->jabatan = $request->jabatan;
            $data->no_hp = $request->no_hp;
            $data->kode_dept = $request->kode_dept;
            $data->password = Hash::make($request->password);
            $data->foto = $imageName;
            $data->save();

            return response()->json(['success' => true], 200);
        } else {
            //Simpan data
            $data = new Karyawan();
            $data->username = $request->username;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->nik = $request->nik;
            $data->jabatan = $request->jabatan;
            $data->no_hp = $request->no_hp;
            $data->kode_dept = $request->kode_dept;
            $data->password = Hash::make($request->password);
            $data->save();

            return response()->json(['success' => true], 200);
        }
    }
}
