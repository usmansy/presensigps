@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Data
                    </div>
                    <h2 class="page-title">
                        Pegawai
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-inputKaryawan">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('pegawai') }}" method="get">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" name="nama_karyawan" id="nama_karyawan"
                                                        class="form-control" placeholder="Nama Pegawai"
                                                        value="{{ Request('nama_karyawan') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <select name="kode_dept" id="kode_dept" class="form-select">
                                                        <option value="">Departemen</option>
                                                        @foreach ($departemen as $item)
                                                            <option
                                                                {{ Request('kode_dept') == $item->kode_dept ? 'selected' : '' }}
                                                                value="{{ $item->kode_dept }}">{{ $item->nama_dept }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-search" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                        </svg>Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Jabatan</th>
                                                    <th>No. HP</th>
                                                    <th>Foto</th>
                                                    <th>Departemen</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($karyawan as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                                        <td>{{ $item->username }}</td>
                                                        <td>{{ $item->nama_lengkap }}</td>
                                                        <td>{{ $item->jabatan }}</td>
                                                        <td>{{ $item->no_hp }}</td>
                                                        <td><img src="{{ !empty($item->foto) ? url('upload/image/karyawan/' . $item->foto) : url('assets/img/sample/avatar/avatar1.jpg') }}"
                                                                alt="avatar" class="avatar"></td>
                                                        <td>{{ $item->nama_dept }}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                        {{ $karyawan->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal modal-blur fade" id="modal-inputKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form action="{{ route('pegawai.store') }}" method="post" id="frmKaryawan"> --}}
                    <div id="errorContainer" class="text-danger"></div>
                    <form id="myForm">
                        @csrf
                        <ul class="text-danger" id="formErrors"></ul>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </span>
                                    <input type="text" name="username" id="username" value=""
                                        class="form-control" placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-user-square" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 10a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            <path d="M6 21v-1a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v1" />
                                            <path
                                                d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                        </svg>
                                    </span>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" value=""
                                        class="form-control" placeholder="Nama Lengkap">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 10l2 -2v8" />
                                            <path
                                                d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3" />
                                            <path
                                                d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5" />
                                        </svg>
                                    </span>
                                    <input type="text" name="nik" id="nik" value=""
                                        class="form-control" placeholder="NIK/NIP">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-arrows-split" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M21 17h-8l-3.5 -5h-6.5" />
                                            <path d="M21 7h-8l-3.495 5" />
                                            <path d="M18 10l3 -3l-3 -3" />
                                            <path d="M18 20l3 -3l-3 -3" />
                                        </svg>
                                    </span>
                                    <input type="text" name="jabatan" id="jabatan" value=""
                                        class="form-control" placeholder="Jabatan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-device-mobile" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M6 5a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-14z" />
                                            <path d="M11 4h2" />
                                            <path d="M12 17v.01" />
                                        </svg>
                                    </span>
                                    <input type="text" name="no_hp" id="no_hp" value=""
                                        class="form-control" placeholder="No HP">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <select name="kode_dept" id="kode_deptInput" class="form-select">
                                        <option value="">Departemen</option>
                                        @foreach ($departemen as $item)
                                            <option value="{{ $item->kode_dept }}">{{ $item->nama_dept }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                            <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                        </svg>
                                    </span>
                                    <input type="password" name="password" id="password" value=""
                                        class="form-control" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-label">Foto</div>
                                <input type="file" name="foto" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 14l11 -11" />
                                        <path
                                            d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                    </svg>
                                    Simpan
                                    <div class="spinner-border text-light" role="status" id="spinner"
                                        style="display: none;">
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault();
                $("#spinner").show();

                $.ajax({
                    type: "post",
                    url: "{{ route('pegawai.store') }}",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        //handle success
                        $('#username').removeClass('is-invalid');
                        $('#nama_lengkap').removeClass('is-invalid');
                        $('#jabatan').removeClass('is-invalid');
                        $('#kode_dept').removeClass('is-invalid');
                        $('#no_hp').removeClass('is-invalid');
                        $('#password').removeClass('is-invalid');
                        $("#spinner").hide();
                    },
                    error: function(response) {
                        $('#formErrors').empty();
                        if (response.responseJSON.errors.username) {
                            $('#username').addClass('is-invalid');
                            response.responseJSON.errors.username.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        } else {
                            $('#username').removeClass('is-invalid');
                        }
                        if (response.responseJSON.errors.nama_lengkap) {
                            $('#nama_lengkap').addClass('is-invalid');
                            response.responseJSON.errors.nama_lengkap.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                        if (response.responseJSON.errors.nik) {
                            $('#nik').addClass('is-invalid');
                            response.responseJSON.errors.nik.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                        if (response.responseJSON.errors.jabatan) {
                            $('#jabatan').addClass('is-invalid');
                            response.responseJSON.errors.jabatan.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                        if (response.responseJSON.errors.kode_dept) {
                            $('#kode_deptInput').addClass('is-invalid');
                            response.responseJSON.errors.kode_dept.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                        if (response.responseJSON.errors.no_hp) {
                            $('#no_hp').addClass('is-invalid');
                            response.responseJSON.errors.no_hp.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                        if (response.responseJSON.errors.password) {
                            $('#password').addClass('is-invalid');
                            response.responseJSON.errors.password.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        }
                        $("#spinner").hide();
                    }
                });
            });
        });

        // $("#myForm").submit(function(e) {
        //     e.preventDefault();

        //     $("#spinner").show();
        //     $.ajax({
        //         type: "post",
        //         url: "{{ route('pegawai.store') }}",
        //         data: $("#myForm").serialize(),
        //         success: function(response) {
        //             alert('Form berhasil disimpan');
        //             $("#spinner").hide();
        //         },
        //         error: function(response) {
        //             var errors = response.responseJSON.errors;
        //             var errorContainer = $("#errorContainer");

        //             errorContainer.html('');
        //             $.each(errors, function(field, messages) {
        //                 $.each(messages, function(index, message) {
        //                     errorContainer.append('<p>' + message + '<p>');
        //                 });
        //             });
        //             $("#spinner").hide();
        //         }
        //     });
        // });




        // $("#frmKaryawan").submit(function(e) {
        //     var username = $("#username").val();
        //     var nama_lengkap = $("#nama_lengkap").val();
        //     var nik = $("#nik").val();
        //     var jabatan = $("#jabatan").val();
        //     var no_hp = $("#no_hp").val();
        //     var kode_dept = $("#kode_dept").val();
        //     var password = $("#password").val();

        //     if (username == "") {
        //         Swal.fire({
        //             title: 'Peringatan!',
        //             text: 'Username wajib diisi',
        //             icon: 'warning',
        //             confirmButtonText: 'Ya'
        //         });
        //         return false;
        //     } else if (nama_lengkap == "") {
        //         Swal.fire({
        //             title: 'Peringatan!',
        //             text: 'Nama Lengkap wajib diisi',
        //             icon: 'warning',
        //             confirmButtonText: 'Ya'
        //         });
        //         return false;
        //     } else if (nik == "") {
        //         Swal.fire({
        //             title: 'Peringatan!',
        //             text: 'NIK/NIP wajib diisi',
        //             icon: 'warning',
        //             confirmButtonText: 'Ya'
        //         });
        //         return false;
        //     } else if (jabatan == "") {
        //         Swal.fire({
        //             title: 'Peringatan!',
        //             text: 'Jabatan wajib diisi',
        //             icon: 'warning',
        //             confirmButtonText: 'Ya'
        //         });
        //         return false;
        //     } else if (no_hp == "") {
        //         Swal.fire({
        //             title: 'Peringatan!',
        //             text: 'No. HP wajib diisi',
        //             icon: 'warning',
        //             confirmButtonText: 'Ya'
        //         });
        //         return false;
        //     } else if (kode_dept == "") {
        //         Swal.fire({
        //             title: 'Peringatan!',
        //             text: 'Departemen wajib diisi',
        //             icon: 'warning',
        //             confirmButtonText: 'Ya'
        //         });
        //         return false;
        //     } else if (password == "") {
        //         Swal.fire({
        //             title: 'Peringatan!',
        //             text: 'Password wajib diisi',
        //             icon: 'warning',
        //             confirmButtonText: 'Ya'
        //         });
        //         return false;
        //     }

        // });
    </script>
@endpush
