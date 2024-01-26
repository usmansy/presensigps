@extends('layouts.presensi')
@section('header')
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
            <form action="#" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" name="" id="cuppaDatePickerContainer" placeholder="Tanggal" class="form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
