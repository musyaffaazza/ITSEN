<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Presensi Pertemuan | ITSEN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f8f9fd] font-sans text-[#172044]">
<div class="min-h-screen lg:grid lg:grid-cols-[250px_1fr]">
    <!-- Sidebar -->
    <aside class="sticky top-0 h-screen hidden border-r border-[#e7e9f4] bg-white lg:flex lg:flex-col">
        <div class="flex h-[64px] items-center gap-3 border-b border-[#e7e9f4] px-7">
            <img src="{{ asset('images/logo-it.jpeg') }}" alt="Logo ITSEN" width="36" height="36" class="h-9 w-9 rounded-xl object-cover">
            <div>
                <p class="font-bold leading-tight">ITSEN</p>
                <p class="text-[11px] text-[#7a82a8]">Admin Portal</p>
            </div>
        </div>
        @include('components.admin.sidebar', ['active' => 'pertemuan'])
        <x-admin.footer />
    </aside>

    <!-- Main Content -->
    <main>
        <x-admin.header title="Detail Presensi Pertemuan" />

        <div class="mx-auto max-w-[1440px] px-5 py-7 sm:px-8 sm:py-8">
            @php
                preg_match('/(?:Pertemuan\s*)?(\d+)/i', $pertemuan->judul, $m);
                $pNum = isset($m[1]) ? $m[1] : $pertemuan->id;
            @endphp

            <!-- Breadcrumb & Top Navigation -->
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <nav class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <a href="/pertemuan" class="text-slate-500 hover:text-blue-600 transition">Pertemuan</a>
                        <span class="text-slate-400">›</span>
                        <span class="text-slate-500">Pertemuan {{ $pNum }}</span>
                        <span class="text-slate-400">›</span>
                        <span class="font-bold text-slate-900">Detail Presensi</span>
                    </nav>
                    <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">Detail Presensi Pertemuan</h1>
                </div>

                <div class="shrink-0">
                    <a href="/pertemuan" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 transition shadow-2xs">
                        <svg class="h-3.5 w-3.5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        <span>Kembali ke Daftar Pertemuan</span>
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mt-4 flex items-center justify-between rounded-xl border border-[#b7f0d4] bg-[#f0fff8] px-4 py-3 text-sm font-semibold text-[#168349]">
                    <div class="flex items-center gap-2">
                        <span>✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-[#168349]/60 hover:text-[#168349]">✕</button>
                </div>
            @endif

            <!-- HERO SESSION CARD (Clean White Container) -->
            <section class="mt-6 rounded-3xl bg-white p-6 sm:p-7 shadow-xs border border-slate-100">
                <!-- Top Badges & Right Actions Row -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center rounded-full bg-[#eef2ff] px-3.5 py-1 text-[11px] font-bold tracking-wider text-[#4f46e5]">
                            MODUL PEMBELAJARAN • BACKEND WEB
                        </span>

                        @if ($pertemuan->status === 'berjalan')
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#ecfdf5] border border-[#a7f3d0] px-3 py-1 text-xs font-bold text-[#059669]">
                                <span class="h-2 w-2 rounded-full bg-[#059669] animate-pulse"></span>
                                <span>Sesi Dibuka</span>
                            </span>
                        @elseif ($pertemuan->status === 'selesai')
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 border border-slate-200 px-3 py-1 text-xs font-bold text-slate-700">
                                <span>✓</span>
                                <span>Sesi Ditutup</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-purple-50 border border-purple-200 px-3 py-1 text-xs font-bold text-purple-700">
                                <span>◷</span>
                                <span>Terjadwal</span>
                            </span>
                        @endif

                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500">
                            <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.55a11 11 0 0 1 14.08 0"/><path d="M1.42 9a16 16 0 0 1 21.16 0"/><path d="M8.53 16.11a6 6 0 0 1 6.95 0"/><line x1="12" y1="20" x2="12.01" y2="20"/></svg>
                            <span>Presensi Mandiri Aktif</span>
                        </span>
                    </div>

                    <!-- Right Action Buttons -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button type="button" onclick="window.location.reload()" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 transition shadow-2xs cursor-pointer">
                            <svg class="h-3.5 w-3.5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                            <span>Muat Ulang</span>
                        </button>

                        <button type="button" onclick="openQrModal()" class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2 text-xs font-bold text-[#2563eb] hover:bg-blue-50 transition shadow-2xs cursor-pointer">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            <span>Kode QR</span>
                        </button>

                        @if ($pertemuan->status === 'berjalan')
                            <form method="POST" action="/pertemuan/{{ $pertemuan->id }}/tutup" onsubmit="return confirm('Tutup sesi presensi pertemuan ini?')">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-[#fee2e2]/70 hover:bg-[#fee2e2] border border-red-200 px-4 py-2 text-xs font-bold text-[#dc2626] transition shadow-2xs cursor-pointer">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <span>Tutup Sesi Presensi</span>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="/pertemuan/{{ $pertemuan->id }}/buka">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-[#ecfdf5] hover:bg-[#d1fae5] border border-emerald-200 px-4 py-2 text-xs font-bold text-[#059669] transition shadow-2xs cursor-pointer">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                    <span>Buka Sesi Presensi</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Session Title -->
                <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900">{{ $pertemuan->judul }}</h2>

                <!-- 4 Metadata Columns -->
                <div class="mt-6 grid grid-cols-2 gap-4 text-xs md:grid-cols-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-slate-400">Tanggal</p>
                            <p class="mt-0.5 font-bold text-slate-900 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($pertemuan->tanggal)->translatedFormat('l, d F Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-slate-400">Waktu</p>
                            <p class="mt-0.5 font-bold text-slate-900 text-xs sm:text-sm">{{ substr($pertemuan->jam_mulai, 0, 5) }} - {{ substr($pertemuan->jam_selesai, 0, 5) }} WIB</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-slate-400">Ruang & Geofence</p>
                            <p class="mt-0.5 font-bold text-slate-900 text-xs sm:text-sm">{{ $pertemuan->catatan ?: 'Lab Komputer 2 (R: 50m)' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-slate-400">Pembina IT Club</p>
                            <p class="mt-0.5 font-bold text-slate-900 text-xs sm:text-sm">{{ $pertemuan->pembuat?->nama ?? 'M. Rizky, S.Kom' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Inner Target Box -->
                <div class="mt-6 rounded-2xl bg-[#eff4fe]/70 border border-[#e2e8f0]/80 p-4 sm:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="h-10 w-10 rounded-xl bg-[#dbeafe] text-[#2563eb] flex items-center justify-center shrink-0">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900"><b>{{ $totalRecorded }} dari {{ $totalSiswa }} Siswa</b> <span class="font-normal text-slate-500">telah tercatat</span></p>
                            <p class="text-xs text-slate-400 mt-0.5">Target kehadiran penuh sebelum {{ substr($pertemuan->jam_selesai, 0, 5) }} WIB</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div class="w-full md:w-80 h-2.5 rounded-full bg-slate-200 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 transition-all duration-500" style="width: {{ $persentase }}%"></div>
                        </div>
                        <span class="text-sm font-black text-[#2563eb] shrink-0">{{ $persentase }}%</span>
                    </div>
                </div>
            </section>

            <!-- 5 STATS SUMMARY CARDS (Soft Pastel Card Styles) -->
            <section class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                <!-- Hadir -->
                <div class="rounded-2xl bg-[#f0fdf4]/80 border border-emerald-100 p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[#16a34a]">Hadir</span>
                        <div class="h-6 w-6 rounded-full border border-emerald-200 text-[#16a34a] flex items-center justify-center text-xs">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $hadirCount }}</p>
                        <p class="mt-1 text-xs text-slate-500">Tepat waktu</p>
                    </div>
                </div>

                <!-- Terlambat -->
                <div class="rounded-2xl bg-[#fffbeb]/80 border border-amber-100 p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[#d97706]">Terlambat</span>
                        <div class="h-6 w-6 rounded-full border border-amber-200 text-[#d97706] flex items-center justify-center text-xs">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $terlambatCount }}</p>
                        <p class="mt-1 text-xs text-slate-500">Lewat toleransi {{ $pertemuan->toleransi_menit ?? 15 }}m</p>
                    </div>
                </div>

                <!-- Izin -->
                <div class="rounded-2xl bg-[#eff6ff]/80 border border-blue-100 p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[#2563eb]">Izin</span>
                        <div class="h-6 w-6 rounded-full border border-blue-200 text-[#2563eb] flex items-center justify-center text-xs">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><polyline points="3 7 12 13 21 7"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $izinCount }}</p>
                        <p class="mt-1 text-xs text-slate-500">Dispensasi lomba</p>
                    </div>
                </div>

                <!-- Sakit -->
                <div class="rounded-2xl bg-[#faf5ff]/80 border border-purple-100 p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[#9333ea]">Sakit</span>
                        <div class="h-6 w-6 rounded-full border border-purple-200 text-[#9333ea] flex items-center justify-center text-xs">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $sakitCount }}</p>
                        <p class="mt-1 text-xs text-slate-500">Surat keterangan</p>
                    </div>
                </div>

                <!-- Alpa / Belum -->
                <div class="rounded-2xl bg-[#fff1f2]/80 border border-rose-100 p-5 shadow-2xs flex flex-col justify-between">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-[#e11d48]">Alpa / Belum</span>
                        <div class="h-6 w-6 rounded-full border border-rose-200 text-[#e11d48] flex items-center justify-center text-xs">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $alpaCount }}</p>
                        <p class="mt-1 text-xs text-slate-500">Menunggu presensi</p>
                    </div>
                </div>
            </section>

            <!-- TABS, SEARCH, AND ATTENDANCE TABLE SECTION -->
            <section class="mt-6 rounded-3xl bg-white p-6 sm:p-7 shadow-xs border border-slate-100">
                <!-- Tabs Row & Export Button -->
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-slate-100">
                    <div class="flex items-center gap-6">
                        <a href="{{ url('/pertemuan/' . $pertemuan->id . '?tab=sudah' . ($search ? '&q='.urlencode($search) : '') . ($statusFilter !== 'semua' ? '&status='.$statusFilter : '')) }}"
                           class="pb-3 text-sm font-bold transition inline-flex items-center gap-2 {{ $tab === 'sudah' ? 'text-[#2563eb] border-b-2 border-[#2563eb]' : 'text-slate-500 hover:text-slate-800' }}">
                            <span>Sudah Absen</span>
                            <span class="rounded-full px-2 py-0.5 text-xs font-bold {{ $tab === 'sudah' ? 'bg-blue-100 text-[#2563eb]' : 'bg-slate-100 text-slate-500' }}">{{ $totalRecorded }}</span>
                        </a>

                        <a href="{{ url('/pertemuan/' . $pertemuan->id . '?tab=belum' . ($search ? '&q='.urlencode($search) : '') ) }}"
                           class="pb-3 text-sm font-bold transition inline-flex items-center gap-2 {{ $tab === 'belum' ? 'text-[#2563eb] border-b-2 border-[#2563eb]' : 'text-slate-500 hover:text-slate-800' }}">
                            <span>Belum Absen</span>
                            <span class="rounded-full px-2 py-0.5 text-xs font-bold {{ $tab === 'belum' ? 'bg-blue-100 text-[#2563eb]' : 'bg-slate-100 text-slate-500' }}">{{ $alpaCount }}</span>
                        </a>
                    </div>

                    <div class="pb-3">
                        <a href="/pertemuan/{{ $pertemuan->id }}/ekspor" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 transition shadow-2xs">
                            <svg class="h-4 w-4 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            <span>Ekspor Presensi (Excel/PDF)</span>
                        </a>
                    </div>
                </div>

                <!-- Search & Status Filter Row -->
                <form method="GET" action="/pertemuan/{{ $pertemuan->id }}" class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <input type="hidden" name="tab" value="{{ $tab }}">

                    <div class="relative w-full sm:w-96">
                        <span class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </span>
                        <input type="search" name="q" value="{{ $search }}" placeholder="Cari nama atau NIS siswa..." 
                               class="w-full rounded-xl border border-slate-200 bg-white py-2 pl-9 pr-3 text-xs text-slate-800 placeholder-slate-400 outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    </div>

                    @if ($tab === 'sudah')
                        <div class="flex items-center gap-2.5">
                            <span class="text-xs text-slate-500 font-medium">Filter Status:</span>
                            <div class="relative">
                                <select name="status" onchange="this.form.submit()" class="appearance-none rounded-xl border border-slate-200 bg-white pl-3.5 pr-8 py-2 text-xs font-semibold text-slate-800 outline-none cursor-pointer hover:bg-slate-50 transition">
                                    <option value="semua" {{ $statusFilter === 'semua' ? 'selected' : '' }}>Semua Status ({{ $totalRecorded }})</option>
                                    <option value="hadir" {{ $statusFilter === 'hadir' ? 'selected' : '' }}>Hadir ({{ $hadirCount }})</option>
                                    <option value="terlambat" {{ $statusFilter === 'terlambat' ? 'selected' : '' }}>Terlambat ({{ $terlambatCount }})</option>
                                    <option value="izin" {{ $statusFilter === 'izin' ? 'selected' : '' }}>Izin ({{ $izinCount }})</option>
                                    <option value="sakit" {{ $statusFilter === 'sakit' ? 'selected' : '' }}>Sakit ({{ $sakitCount }})</option>
                                </select>
                                <span class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-xs text-slate-400">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                            </div>
                            <button type="button" class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition cursor-pointer" aria-label="Filter tambahan">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="7" y1="12" x2="17" y2="12"/><line x1="10" y1="18" x2="14" y2="18"/></svg>
                            </button>
                        </div>
                    @endif
                </form>

                <!-- TABLE CONTENT -->
                <div class="mt-4 overflow-x-auto">
                    @if ($tab === 'sudah')
                        <!-- SUDAH ABSEN TABLE -->
                        <table class="w-full text-left text-xs">
                            <thead class="border-b border-slate-100 text-[11px] font-bold text-slate-500">
                                <tr>
                                    <th class="py-3.5 px-3">Siswa</th>
                                    <th class="py-3.5 px-3">Waktu Presensi</th>
                                    <th class="py-3.5 px-3">Status Kehadiran</th>
                                    <th class="py-3.5 px-3">Jarak GPS & Geofencing</th>
                                    <th class="py-3.5 px-3">Verifikasi Swafoto / Bukti</th>
                                    <th class="py-3.5 px-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($sudahAbsenList as $index => $row)
                                    @php
                                        $initials = collect(explode(' ', $row->nama_lengkap))->map(fn($w)=>mb_substr($w,0,1))->take(2)->join('');
                                        $avatarStyles = [
                                            ['bg' => 'bg-[#dbeafe]', 'text' => 'text-[#1d4ed8]'],
                                            ['bg' => 'bg-[#f3e8ff]', 'text' => 'text-[#7e22ce]'],
                                            ['bg' => 'bg-[#e0f2fe]', 'text' => 'text-[#0369a1]'],
                                            ['bg' => 'bg-[#dbeafe]', 'text' => 'text-[#1d4ed8]'],
                                            ['bg' => 'bg-[#f3e8ff]', 'text' => 'text-[#7e22ce]'],
                                            ['bg' => 'bg-[#ccfbf1]', 'text' => 'text-[#0f766e]'],
                                        ];
                                        $avatarStyle = $avatarStyles[$index % count($avatarStyles)];
                                        $waktuFormatted = substr($row->waktu_absen, 11, 5) . ' WIB';
                                    @endphp
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <!-- Siswa -->
                                        <td class="py-3.5 px-3">
                                            <div class="flex items-center gap-3">
                                                <div class="h-9 w-9 rounded-full {{ $avatarStyle['bg'] }} {{ $avatarStyle['text'] }} font-bold flex items-center justify-center text-xs shrink-0">
                                                    {{ $initials }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-900 text-xs sm:text-sm">{{ $row->nama_lengkap }}</p>
                                                    <p class="text-[11px] text-slate-400 mt-0.5">NIS: {{ $row->nit }} • {{ $row->kelas_jurusan }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Waktu Presensi -->
                                        <td class="py-3.5 px-3 font-semibold">
                                            @if ($row->status === 'hadir')
                                                <div class="flex items-center gap-1.5 text-slate-700 font-bold">
                                                    <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                                    <span>{{ $waktuFormatted }}</span>
                                                </div>
                                            @elseif ($row->status === 'terlambat')
                                                <div class="flex items-center gap-1.5 text-amber-600 font-bold">
                                                    <svg class="h-3.5 w-3.5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                                    <span>{{ $waktuFormatted }}</span>
                                                    <span class="text-[11px] font-normal text-amber-600">({{ $row->keterangan ?: '+22 menit' }})</span>
                                                </div>
                                            @elseif ($row->status === 'izin')
                                                <div class="flex items-center gap-1.5 text-blue-600 font-bold">
                                                    <svg class="h-3.5 w-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                                    <span>{{ $waktuFormatted }}</span>
                                                </div>
                                            @elseif ($row->status === 'sakit')
                                                <div class="flex items-center gap-1.5 text-purple-600 font-bold">
                                                    <svg class="h-3.5 w-3.5 text-purple-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                    <span>{{ $waktuFormatted }}</span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Status Kehadiran -->
                                        <td class="py-3.5 px-3">
                                            @if ($row->status === 'hadir')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#ecfdf5] border border-[#a7f3d0] px-3 py-1 text-xs font-semibold text-[#059669]">
                                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                    <span>Hadir</span>
                                                </span>
                                            @elseif ($row->status === 'terlambat')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#fffbeb] border border-[#fde68a] px-3 py-1 text-xs font-semibold text-[#d97706]">
                                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                                    <span>Terlambat</span>
                                                </span>
                                            @elseif ($row->status === 'izin')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#eff6ff] border border-[#bfdbfe] px-3 py-1 text-xs font-semibold text-[#2563eb]">
                                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                                    <span>Izin</span>
                                                </span>
                                            @elseif ($row->status === 'sakit')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#faf5ff] border border-[#e9d5ff] px-3 py-1 text-xs font-semibold text-[#9333ea]">
                                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                    <span>Sakit</span>
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Jarak GPS & Geofencing -->
                                        <td class="py-3.5 px-3">
                                            @if ($row->status === 'hadir' || $row->status === 'terlambat')
                                                <div class="flex items-center gap-2">
                                                    <svg class="h-4 w-4 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="22" y1="12" x2="18" y2="12"/><line x1="6" y1="12" x2="2" y2="12"/><line x1="12" y1="6" x2="12" y2="2"/><line x1="12" y1="22" x2="12" y2="18"/></svg>
                                                    <div class="leading-tight">
                                                        <span class="font-bold text-slate-800 text-xs">{{ (int)$row->jarak_meter }} meter</span>
                                                        <span class="text-[11px] text-slate-500 block sm:inline">(Dalam Radius Lab)</span>
                                                    </div>
                                                </div>
                                            @elseif ($row->status === 'izin')
                                                <span class="text-xs text-slate-500">- (Dispensasi Sekolah)</span>
                                            @elseif ($row->status === 'sakit')
                                                <span class="text-xs text-slate-500">- (Surat Dokter)</span>
                                            @endif
                                        </td>

                                        <!-- Verifikasi Swafoto / Bukti -->
                                        <td class="py-3.5 px-3">
                                            @if ($row->status === 'hadir' || $row->status === 'terlambat')
                                                <div class="flex items-center gap-2">
                                                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#eff6ff] text-[#2563eb] shrink-0">
                                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                                    </div>
                                                    <span class="inline-flex items-center gap-1 rounded-full bg-[#ecfdf5] border border-[#a7f3d0] px-2.5 py-0.5 text-[11px] font-semibold text-[#059669]">
                                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                        <span>Terverifikasi</span>
                                                    </span>
                                                </div>
                                            @elseif ($row->status === 'izin')
                                                <div class="flex items-center gap-1.5 text-slate-700">
                                                    <svg class="h-4 w-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                                    <span class="text-xs font-semibold text-slate-800">{{ $row->foto_path ?: 'Surat Dispensasi LKS.pdf' }}</span>
                                                </div>
                                            @elseif ($row->status === 'sakit')
                                                <div class="flex items-center gap-1.5 text-slate-700">
                                                    <svg class="h-4 w-4 text-purple-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                                    <span class="text-xs font-semibold text-slate-800">{{ $row->foto_path ?: 'Surat_Dokter_Puskesmas.jpg' }}</span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Aksi -->
                                        <td class="py-3.5 px-3 text-center">
                                            @if ($row->status === 'hadir' || $row->status === 'terlambat')
                                                <button type="button" 
                                                        onclick="openSwafotoModal('{{ $row->nama_lengkap }}', '{{ $row->nit }}', '{{ $row->kelas_jurusan }}', '{{ $row->status }}', '{{ $waktuFormatted }}', '{{ (int)$row->jarak_meter }}', '{{ $row->latitude }}', '{{ $row->longitude }}')"
                                                        class="h-8 w-8 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-500 inline-flex items-center justify-center transition cursor-pointer" title="Lihat Swafoto & Geofence">
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                                </button>
                                            @else
                                                <button type="button" 
                                                        onclick="openBuktiModal('{{ $row->nama_lengkap }}', '{{ $row->nit }}', '{{ $row->kelas_jurusan }}', '{{ ucfirst($row->status) }}', '{{ $row->keterangan }}', '{{ $row->foto_path }}', '{{ $row->status === 'izin' ? 'pdf' : 'image' }}')"
                                                        class="inline-flex items-center gap-1.5 rounded-xl border border-blue-200 bg-white hover:bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-600 transition shadow-2xs cursor-pointer">
                                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="12" y2="12"/><line x1="15" y1="15" x2="12" y2="12"/></svg>
                                                    <span>Lihat Bukti</span>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-slate-400">
                                            Tidak ada data presensi yang sesuai dengan filter.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination Footer -->
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-5 border-t border-slate-100 mt-2">
                            <p class="text-xs text-slate-500">
                                Menampilkan <b>{{ $sudahAbsenList->count() }}</b> dari <b>{{ $totalRecorded }}</b> siswa hadir/izin/sakit
                            </p>
                            <div class="flex items-center gap-1">
                                @for ($page = 1; $page <= max(1, $sudahAbsenList->lastPage()); $page++)
                                    @if ($page == $sudahAbsenList->currentPage())
                                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-600">{{ $page }}</span>
                                    @else
                                        <a href="{{ $sudahAbsenList->url($page) }}" class="flex h-7 w-7 items-center justify-center rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ $page }}</a>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    @else
                        <!-- BELUM ABSEN TABLE -->
                        <table class="w-full text-left text-xs">
                            <thead class="border-b border-slate-100 text-[11px] font-bold text-slate-500">
                                <tr>
                                    <th class="py-3.5 px-3">Siswa</th>
                                    <th class="py-3.5 px-3">Kelas</th>
                                    <th class="py-3.5 px-3">Status</th>
                                    <th class="py-3.5 px-3">Kontak WhatsApp</th>
                                    <th class="py-3.5 px-3 text-center">Aksi Manual</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($belumAbsenList as $b)
                                    @php
                                        $bInitials = collect(explode(' ', $b->nama_lengkap))->map(fn($w)=>mb_substr($w,0,1))->take(2)->join('');
                                    @endphp
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="py-3.5 px-3">
                                            <div class="flex items-center gap-3">
                                                <div class="h-9 w-9 rounded-full bg-slate-100 text-slate-600 font-bold flex items-center justify-center text-xs shrink-0">
                                                    {{ $bInitials }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-900 text-xs sm:text-sm">{{ $b->nama_lengkap }}</p>
                                                    <p class="text-[11px] text-slate-400 mt-0.5">NIS: {{ $b->nit }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-3 font-semibold text-slate-700">
                                            {{ $b->kelas_jurusan }}
                                        </td>
                                        <td class="py-3.5 px-3">
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#fff1f2] border border-[#fecdd3] px-3 py-1 text-xs font-semibold text-[#e11d48]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-[#e11d48]"></span>
                                                <span>Belum Presensi</span>
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-3">
                                            @if($b->no_hp)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $b->no_hp) }}" target="_blank" class="inline-flex items-center gap-1.5 text-emerald-600 hover:text-emerald-700 font-semibold hover:underline">
                                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                                    <span>{{ $b->no_hp }}</span>
                                                </a>
                                            @else
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-3 text-center">
                                            <button type="button" onclick="alert('Fitur tandai presensi manual untuk {{ $b->nama_lengkap }} siap digunakan.')" class="rounded-xl border border-blue-200 bg-white hover:bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-600 transition shadow-2xs cursor-pointer">
                                                Tandai Hadir
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-slate-400">
                                            Semua siswa telah tercatat hadir pada pertemuan ini!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination Footer -->
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-5 border-t border-slate-100 mt-2">
                            <p class="text-xs text-slate-500">
                                Menampilkan <b>{{ $belumAbsenList->count() }}</b> dari <b>{{ $alpaCount }}</b> siswa belum presensi
                            </p>
                            <div class="flex items-center gap-1">
                                @for ($page = 1; $page <= max(1, $belumAbsenList->lastPage()); $page++)
                                    @if ($page == $belumAbsenList->currentPage())
                                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-blue-600">{{ $page }}</span>
                                    @else
                                        <a href="{{ $belumAbsenList->url($page) }}" class="flex h-7 w-7 items-center justify-center rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100">{{ $page }}</a>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <!-- BOTTOM STATUS & GEOFENCE BAR -->
            <section class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3 rounded-2xl bg-white p-4 shadow-xs border border-slate-100 text-xs text-slate-600">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                    <span><b>Pembaruan otomatis aktif</b> • Sinkronisasi data setiap 30 detik (Terakhir: 15:42 WIB)</span>
                </div>
                <div class="flex items-center gap-1.5 text-slate-500">
                    <svg class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Geofence Lab Komputer 2 (Lat: -6.2088, Long: 106.8456 • Radius 50m)</span>
                </div>
            </section>
        </div>
    </main>
</div>

<!-- ==================== MODAL KODE QR ==================== -->
<div id="qrModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl ring-1 ring-slate-200">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Kode QR Presensi Mandiri Siswa</h3>
                <p class="text-xs text-slate-500 mt-0.5">{{ $pertemuan->judul }}</p>
            </div>
            <button type="button" onclick="closeQrModal()" class="h-8 w-8 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 flex items-center justify-center text-lg cursor-pointer">✕</button>
        </div>

        <div class="mt-5 flex flex-col items-center">
            <!-- QR Code Canvas / SVG -->
            <div class="rounded-2xl border-2 border-dashed border-slate-200 p-4 bg-slate-50 flex flex-col items-center shadow-inner">
                <svg class="h-56 w-56 text-slate-900" viewBox="0 0 200 200" fill="currentColor">
                    <rect x="15" y="15" width="50" height="50" fill="none" stroke="currentColor" stroke-width="10"/>
                    <rect x="30" y="30" width="20" height="20" fill="currentColor"/>
                    <rect x="135" y="15" width="50" height="50" fill="none" stroke="currentColor" stroke-width="10"/>
                    <rect x="150" y="30" width="20" height="20" fill="currentColor"/>
                    <rect x="15" y="135" width="50" height="50" fill="none" stroke="currentColor" stroke-width="10"/>
                    <rect x="30" y="150" width="20" height="20" fill="currentColor"/>
                    <rect x="75" y="20" width="10" height="10"/>
                    <rect x="95" y="20" width="10" height="10"/>
                    <rect x="115" y="20" width="10" height="10"/>
                    <rect x="75" y="40" width="10" height="10"/>
                    <rect x="95" y="40" width="10" height="10"/>
                    <rect x="75" y="60" width="10" height="10"/>
                    <rect x="115" y="60" width="10" height="10"/>
                    <rect x="20" y="75" width="10" height="10"/>
                    <rect x="40" y="75" width="10" height="10"/>
                    <rect x="60" y="75" width="10" height="10"/>
                    <rect x="75" y="75" width="50" height="50"/>
                    <rect x="85" y="85" width="30" height="30" fill="white"/>
                    <rect x="95" y="95" width="10" height="10" fill="currentColor"/>
                    <rect x="135" y="75" width="10" height="10"/>
                    <rect x="155" y="75" width="10" height="10"/>
                    <rect x="175" y="75" width="10" height="10"/>
                    <rect x="20" y="95" width="10" height="10"/>
                    <rect x="60" y="95" width="10" height="10"/>
                    <rect x="145" y="95" width="10" height="10"/>
                    <rect x="165" y="95" width="10" height="10"/>
                    <rect x="20" y="115" width="10" height="10"/>
                    <rect x="40" y="115" width="10" height="10"/>
                    <rect x="135" y="115" width="10" height="10"/>
                    <rect x="175" y="115" width="10" height="10"/>
                    <rect x="75" y="135" width="10" height="10"/>
                    <rect x="95" y="135" width="10" height="10"/>
                    <rect x="115" y="135" width="10" height="10"/>
                    <rect x="135" y="135" width="10" height="10"/>
                    <rect x="155" y="135" width="10" height="10"/>
                    <rect x="75" y="155" width="10" height="10"/>
                    <rect x="115" y="155" width="10" height="10"/>
                    <rect x="155" y="155" width="10" height="10"/>
                    <rect x="175" y="155" width="10" height="10"/>
                    <rect x="75" y="175" width="10" height="10"/>
                    <rect x="95" y="175" width="10" height="10"/>
                    <rect x="135" y="175" width="10" height="10"/>
                    <rect x="155" y="175" width="10" height="10"/>
                </svg>
            </div>

            <!-- Timer info -->
            <div class="mt-4 flex items-center gap-1.5 text-xs text-slate-600 font-semibold">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Kode QR aktif • Diperbarui otomatis dalam <b class="text-emerald-600">45s</b></span>
            </div>
            <p class="mt-1 text-[11px] text-slate-400 text-center">Siswa harus berada di dalam radius 50m Lab Komputer 2 saat memindai.</p>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <button type="button" onclick="closeQrModal()" class="rounded-xl border border-slate-200 px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 cursor-pointer">Tutup</button>
            <button type="button" onclick="alert('Kode QR berhasil disiapkan untuk diunduh / diproyeksikan ke layar lab.')" class="rounded-xl bg-[#1554d6] px-4 py-2 text-xs font-bold text-white hover:bg-[#1146b5] cursor-pointer">Unduh QR (PNG)</button>
        </div>
    </div>
</div>

<!-- ==================== MODAL PREVIEW SWAFOTO ==================== -->
<div id="swafotoModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl ring-1 ring-slate-200">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Verifikasi Swafoto & GPS Geofencing</h3>
                <p id="modalStudentName" class="text-xs text-slate-500 mt-0.5">Budi Santoso (NIS: 20260001)</p>
            </div>
            <button type="button" onclick="closeSwafotoModal()" class="h-8 w-8 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 flex items-center justify-center text-lg cursor-pointer">✕</button>
        </div>

        <div class="mt-4 space-y-4">
            <!-- Simulated Selfie Box -->
            <div class="relative h-56 w-full rounded-2xl bg-gradient-to-tr from-slate-800 to-slate-900 flex flex-col items-center justify-center text-white p-4 overflow-hidden border border-slate-700">
                <div class="h-20 w-20 rounded-full bg-slate-700/80 border-2 border-emerald-400 flex items-center justify-center text-2xl font-black text-emerald-300">
                    <span id="modalAvatarInitials">BS</span>
                </div>
                <p id="modalPhotoDesc" class="mt-3 text-xs font-semibold text-slate-200">Kamera Depan (Android/Chrome)</p>
                <div class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-emerald-500/20 border border-emerald-500/40 px-3 py-1 text-[11px] font-bold text-emerald-300">
                    <span>✓ Wajah Terdeteksi & Cocok</span>
                </div>
                <span class="absolute bottom-3 left-4 text-[10px] text-slate-400" id="modalTimestamp">15:02 WIB • 24 Mei 2025</span>
            </div>

            <!-- GPS & Geofence Details -->
            <div class="rounded-xl bg-slate-50 p-4 border border-slate-200 text-xs space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Status Presensi:</span>
                    <span id="modalStatusBadge" class="font-bold text-emerald-600">● Hadir Tepat Waktu</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Jarak dari Titik Pusat:</span>
                    <span id="modalDistance" class="font-bold text-slate-800">12 meter (Radius aman: 50m)</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Koordinat Presensi:</span>
                    <span id="modalCoords" class="font-mono text-slate-700">Lat: -6.2088000, Long: 106.8456000</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Validasi Geofence:</span>
                    <span class="font-bold text-emerald-700">✓ Terverifikasi di dalam Lab Komputer 2</span>
                </div>
            </div>
        </div>

        <div class="mt-5 flex items-center justify-end border-t border-slate-100 pt-4">
            <button type="button" onclick="closeSwafotoModal()" class="rounded-xl bg-slate-900 px-5 py-2 text-xs font-bold text-white hover:bg-slate-800 cursor-pointer">Tutup</button>
        </div>
    </div>
</div>

<!-- ==================== MODAL PREVIEW SURAT / BUKTI ==================== -->
<div id="buktiModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl ring-1 ring-slate-200">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <div>
                <h3 class="text-base font-extrabold text-slate-900">Bukti Pengajuan Ketidakhadiran</h3>
                <p id="buktiStudentInfo" class="text-xs text-slate-500 mt-0.5">Nadia Putri • XI PPLG 1</p>
            </div>
            <button type="button" onclick="closeBuktiModal()" class="h-8 w-8 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-700 flex items-center justify-center text-lg cursor-pointer">✕</button>
        </div>

        <div class="mt-4 space-y-4">
            <!-- Simulated Document Card -->
            <div class="rounded-2xl border-2 border-dashed border-slate-300 p-6 bg-slate-50 flex flex-col items-center justify-center text-center">
                <div class="h-16 w-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-3xl mb-3">
                    📄
                </div>
                <p id="buktiFileName" class="text-sm font-bold text-slate-800">Surat Dispensasi LKS.pdf</p>
                <p id="buktiCategory" class="text-xs text-slate-500 mt-1">Dispensasi Lomba Kompetensi Siswa (LKS) Tingkat Kota</p>
                <div class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-blue-50 border border-blue-200 px-3 py-1 text-xs font-bold text-blue-700">
                    <span>✓ Surat Keterangan Sah dari Sekolah</span>
                </div>
            </div>
        </div>

        <div class="mt-5 flex items-center justify-end gap-2 border-t border-slate-100 pt-4">
            <button type="button" onclick="closeBuktiModal()" class="rounded-xl border border-slate-200 px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 cursor-pointer">Tutup</button>
            <button type="button" onclick="alert('Mengunduh dokumen lampiran...')" class="rounded-xl bg-[#1554d6] px-4 py-2 text-xs font-bold text-white hover:bg-[#1146b5] cursor-pointer">Unduh Lampiran</button>
        </div>
    </div>
</div>

<!-- Scripts for Modal Controls -->
<script>
function openQrModal() {
    document.getElementById('qrModal').classList.remove('hidden');
}
function closeQrModal() {
    document.getElementById('qrModal').classList.add('hidden');
}

function openSwafotoModal(nama, nit, kelas, status, waktu, jarak, lat, long) {
    document.getElementById('modalStudentName').innerText = nama + ' (NIS: ' + nit + ' • Kelas: ' + kelas + ')';
    const inits = nama.split(' ').map(w => w.charAt(0)).slice(0, 2).join('');
    document.getElementById('modalAvatarInitials').innerText = inits;
    document.getElementById('modalTimestamp').innerText = waktu + ' • Kamera Depan (Geofence Valid)';
    document.getElementById('modalDistance').innerText = jarak + ' meter (Radius aman: 50m)';
    document.getElementById('modalCoords').innerText = 'Lat: ' + (lat || '-6.2088000') + ', Long: ' + (long || '106.8456000');
    
    if (status === 'terlambat') {
        document.getElementById('modalStatusBadge').innerText = '● Terlambat (Lewat toleransi)';
        document.getElementById('modalStatusBadge').className = 'font-bold text-amber-600';
    } else {
        document.getElementById('modalStatusBadge').innerText = '● Hadir Tepat Waktu';
        document.getElementById('modalStatusBadge').className = 'font-bold text-emerald-600';
    }

    document.getElementById('swafotoModal').classList.remove('hidden');
}
function closeSwafotoModal() {
    document.getElementById('swafotoModal').classList.add('hidden');
}

function openBuktiModal(nama, nit, kelas, status, ket, filePath, type) {
    document.getElementById('buktiStudentInfo').innerText = nama + ' • ' + kelas + ' (NIS: ' + nit + ')';
    document.getElementById('buktiFileName').innerText = filePath || (status === 'Izin' ? 'Surat Dispensasi LKS.pdf' : 'Surat_Dokter_Puskesmas.jpg');
    document.getElementById('buktiCategory').innerText = ket || ('Keterangan status ' + status);
    document.getElementById('buktiModal').classList.remove('hidden');
}
function closeBuktiModal() {
    document.getElementById('buktiModal').classList.add('hidden');
}
</script>
</body>
</html>
