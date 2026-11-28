<nav class="px-4 py-7" aria-label="Navigasi admin">
    <p class="mb-3 px-3 text-[10px] font-semibold tracking-[0.12em] text-[#9aa1bd]">MENU NAVIGASI</p>
    <x-admin.nav-link href="{{ url('/') }}" label="Dashboard" icon="dashboard" :active="$active === 'dashboard'" />
    <x-admin.nav-link href="{{ url('/anggota') }}" label="Anggota" icon="users" :active="$active === 'anggota'" />
    <x-admin.nav-link href="{{ url('/pertemuan') }}" label="Pertemuan" icon="calendar" :active="$active === 'pertemuan'" />
    <x-admin.nav-link href="{{ url('/absensi') }}" label="Data Absensi" icon="clipboard" :active="$active === 'absensi'" />
    <x-admin.nav-link href="{{ url('/pengajuan') }}" label="Pengajuan" icon="file-check" badge="3" :active="$active === 'pengajuan'" />
    <x-admin.nav-link href="{{ url('/rekap') }}" label="Rekap" icon="chart" :active="$active === 'rekap'" />
    <x-admin.nav-link href="{{ url('/pengaturan-lokasi') }}" label="Pengaturan Lokasi" icon="map-pin" :active="$active === 'pengaturan-lokasi'" />
</nav>