<div class="appBottomMenu">
    <a href="{{ route('dashboardkaryawan') }}" class="item {{ request()->routeIs('dashboardkaryawan') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Beranda</strong>
        </div>
    </a>
    <a href="{{ route('presensi.histori') }}" class="item {{ request()->routeIs('presensi.histori') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Riwayat</strong>
        </div>
    </a>
    <a href="{{ route('presensi.create') }}" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="{{ route('presensi.izin') }}" class="item {{ request()->routeIs('presensi.izin') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="calendar-outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>
    <a href="{{ route('editprofilekaryawan') }}" class="item {{ request()->routeIs('editprofilekaryawan') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
