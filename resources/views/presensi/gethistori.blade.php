@if ($histori->isEmpty())
<div class="alert alert-warning">
    <p>Data Belum Ada</p>
</div>
@endif
@foreach ($histori as $item)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                <img src="{{ !empty($item->foto_in) ? url('upload/image/presensi/' . $item->foto_in) : '' }}"
                    alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date('d-m-Y', strtotime($item->tgl_presensi)) }}</b><br>
                    </div>
                    <span
                        class="badge {{ $item->jam_in < '07:00' ? 'bg-success' : 'bg-danger' }}">{{ $item->jam_in }}</span>
                    <span class="badge bg-info">{{ $item->jam_out == null ? 'Tidak Absen' : $item->jam_out }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach
