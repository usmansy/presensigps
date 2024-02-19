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
                                                        <td><button class=" btn btn-warning editBtn"
                                                                data-id="{{ $item->id }}"
                                                                data-nik="{{ $item->nik }}"
                                                                data-username="{{ $item->username }}"
                                                                data-nama="{{ $item->nama_lengkap }}"
                                                                data-jabatan="{{ $item->jabatan }}"
                                                                data-dept="{{ $item->kode_dept }}"
                                                                data-hp="{{ $item->no_hp }}" data-bs-toggle="modal"
                                                                data-bs-target="#modal-editKaryawan">Edit</button></td>
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
    @include('karyawan.modal')
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            //Input Data
            $('#myForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('pegawai.store') }}",
                    method: 'post',
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // handle success
                        $('#modal-inputKaryawan').modal('hide');
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Data berhasil disimpan',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // refresh the page
                            }
                        });
                    },
                    error: function(response) {
                        // handle error
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
                        } else {
                            $('#nama_lengkap').removeClass('is-invalid');
                        }
                        if (response.responseJSON.errors.nik) {
                            $('#nik').addClass('is-invalid');
                            response.responseJSON.errors.nik.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        } else {
                            $('#nik').removeClass('is-invalid');
                        }
                        if (response.responseJSON.errors.jabatan) {
                            $('#jabatan').addClass('is-invalid');
                            response.responseJSON.errors.jabatan.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        } else {
                            $('#jabatan').removeClass('is-invalid');
                        }
                        if (response.responseJSON.errors.no_hp) {
                            $('#no_hp').addClass('is-invalid');
                            response.responseJSON.errors.no_hp.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        } else {
                            $('#no_hp').removeClass('is-invalid');
                        }
                        if (response.responseJSON.errors.kode_dept) {
                            $("#myForm").find('#kode_dept').addClass('is-invalid');
                            response.responseJSON.errors.kode_dept.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        } else {
                            $('#myForm').find('#kode_dept').removeClass('is-invalid');
                        }
                        if (response.responseJSON.errors.password) {
                            $('#password').addClass('is-invalid');
                            response.responseJSON.errors.password.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        } else {
                            $('#password').removeClass('is-invalid');
                        }
                        if (response.responseJSON.errors.foto) {
                            $('#foto').addClass('is-invalid');
                            response.responseJSON.errors.foto.forEach(function(error) {
                                $('#formErrors').append('<li>' + error + '</li>');
                            });
                        } else {
                            $('#foto').removeClass('is-invalid');
                        }
                    }
                });
            });

            //Edit Data
            $('.editBtn').on('click', function() {
                var id = $(this).attr('data-id');
                var nik = $(this).attr('data-nik');
                var username = $(this).attr('data-username');
                var nama = $(this).attr('data-nama');
                var jabatan = $(this).attr('data-jabatan');
                var dept = $(this).attr('data-dept');
                var hp = $(this).attr('data-hp');

                //display
                $('#editMyForm').find('#id').val(id);
                $('#editMyForm').find('#username').val(username);
                $('#editMyForm').find('#nama_lengkap').val(nama);
                $('#editMyForm').find('#nik').val(nik);
                $('#editMyForm').find('#jabatan').val(jabatan);
                $('#editMyForm').find('#no_hp').val(hp);
                $('#editMyForm').find('#kode_dept').val(dept);

                //Update

            });
        });
    </script>
@endpush
