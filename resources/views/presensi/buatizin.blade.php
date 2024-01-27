@extends('layouts.presensi')
@section('header')
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Izin/Sakit</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            <form action="{{ route('presensi.storeizin') }}" method="post" id="frmIzin">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><ion-icon name="calendar-outline"></ion-icon></div>
                                <input type="text" class="form-control" id="datepicker" placeholder="Tanggal"
                                    name="tgl_izin">
                            </div>
                        </div>
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option value="">Status</option>
                                <option value="i">Izin</option>
                                <option value="s">Sakit</option>
                                <option value="d">Dinas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100"><ion-icon name="send-outline"></ion-icon>Kirim</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap',
            format: 'yyyy-mm-dd'
        });

        $(document).ready(function() {
            $("#frmIzin").submit(function(e) {
                var tgl_izin = $("#datepicker").val();
                var status = $("#status").val();
                var keterangan = $("#keterangan").val();

                if (tgl_izin == "") {
                    Swal.fire({
                        title: 'Oppss!!',
                        text: "Tanggal harus diisi!",
                        icon: 'warning',
                    });
                    return false;
                } else if (status == "") {
                    Swal.fire({
                        title: 'Oppss!!',
                        text: "Status harus diisi!",
                        icon: 'warning',
                    });
                    return false;
                } else if (keterangan == "") {
                    Swal.fire({
                        title: 'Oppss!!',
                        text: "Keterangan harus diisi!",
                        icon: 'warning',
                    });
                    return false;
                }
            });
        });
    </script>
@endpush
