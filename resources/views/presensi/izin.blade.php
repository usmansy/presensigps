@extends('layouts.presensi')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Izin/Sakit</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            @foreach ($dataIzin as $item)
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ date('d-m-Y', strtotime($item->tgl_izin)) }} <small
                                            class="badge bg-info">{{ $item->status == 's' ? 'Sakit' : ($item->status == 'i' ? 'Izin' : 'Dinas Luar') }}</small></b><br>
                                    <small class="text-muted">{{ $item->keterangan }}</small>
                                    {{-- <small class="text-muted">{{$item->jabatan}}</small> --}}
                                </div>
                                @if ($item->status_approved == 0)
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif ($item->status_approved == 1)
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
    <div class="fab-button bottom-right" style="margin-bottom: 4rem">
        <a href="{{ route('presensi.buatizin') }}" class="fab"><ion-icon name="add-outline"></ion-icon></a>
    </div>
@endsection
