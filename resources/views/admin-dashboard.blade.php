<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard Admin | ITSEN</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f7f7fc] font-sans text-[#152047]">
        <div class="min-h-screen lg:grid lg:grid-cols-[250px_1fr]">
            <aside class="hidden border-r border-[#e7e9f4] bg-white lg:flex lg:flex-col">
                <div class="flex h-[72px] items-center gap-3 border-b border-[#e7e9f4] px-7">
                    <img src="{{ asset('images/logo-it.jpeg') }}" alt="Logo ITSEN" width="36" height="36" class="h-9 w-9 rounded-xl object-cover">
                    <div>
                        <p class="font-bold leading-tight">ITSEN</p>
                        <p class="text-[11px] text-[#7a82a8]">Admin Portal</p>
                    </div>
                </div>

                <nav class="px-4 py-7" aria-label="Navigasi admin">
                    <p class="mb-3 px-3 text-[10px] font-semibold tracking-[0.12em] text-[#9aa1bd]">MENU NAVIGASI</p>
                    <a href="#dashboard" class="flex min-h-11 items-center gap-3 rounded-xl bg-[#f0edff] px-3 text-sm font-semibold text-[#553be4]" aria-current="page">
                        <span class="grid h-6 w-1 rounded-full bg-[#633cf0]"></span>
                        Dashboard
                    </a>
                    <a href="#anggota" class="mt-1 flex min-h-11 items-center gap-3 rounded-xl px-4 text-sm font-medium text-[#414d78] hover:bg-[#f5f5fc]">
                        <span aria-hidden="true">♧</span> Anggota
                    </a>
                    <a href="#pertemuan" class="mt-1 flex min-h-11 items-center gap-3 rounded-xl px-4 text-sm font-medium text-[#414d78] hover:bg-[#f5f5fc]">
                        <span aria-hidden="true">□</span> Pertemuan
                    </a>
                    <a href="#absensi" class="mt-1 flex min-h-11 items-center gap-3 rounded-xl px-4 text-sm font-medium text-[#414d78] hover:bg-[#f5f5fc]">
                        <span aria-hidden="true">▤</span> Data Absensi
                    </a>
                    <a href="#rekap" class="mt-1 flex min-h-11 items-center gap-3 rounded-xl px-4 text-sm font-medium text-[#414d78] hover:bg-[#f5f5fc]">
                        <span aria-hidden="true">▥</span> Rekap
                    </a>
                    <a href="#lokasi" class="mt-1 flex min-h-11 items-center gap-3 rounded-xl px-4 text-sm font-medium text-[#414d78] hover:bg-[#f5f5fc]">
                        <span aria-hidden="true">♢</span> Pengaturan Lokasi
                    </a>
                </nav>

                <div class="mt-auto border-t border-[#e7e9f4] p-4">
                    <div class="flex items-center gap-3 px-3 py-3">
                        <span class="grid h-9 w-9 place-items-center rounded-full bg-[#eadffd] text-xs font-bold text-[#633cf0]">AD</span>
                        <div>
                            <p class="text-sm font-bold">Admin Ekskul</p>
                            <p class="text-[11px] text-[#7a82a8]">Pembina IT Club</p>
                        </div>
                    </div>
                    <button type="button" class="mt-1 flex min-h-11 w-full items-center justify-center gap-2 rounded-xl border border-[#e6e8f2] text-sm font-semibold text-[#e14a63] hover:bg-[#fff4f5]">Keluar</button>
                </div>
            </aside>

            <main id="dashboard">
                <header class="flex min-h-[72px] items-center justify-between border-b border-[#e7e9f4] bg-white px-5 sm:px-8">
                    <div class="flex items-center gap-4">
                        <button type="button" class="grid h-11 w-11 place-items-center rounded-xl border border-[#e5e7f1] lg:hidden" aria-label="Buka navigasi">☰</button>
                        <div>
                            <h1 class="text-lg font-bold">Dashboard</h1>
                            <p class="text-xs text-[#7a82a8]">Sabtu, 24 Mei 2025</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="hidden w-60 items-center gap-2 rounded-xl bg-[#f4f5fb] px-4 py-2 text-xs text-[#7a82a8] sm:flex">
                            <span aria-hidden="true">⌕</span>
                            <input type="search" class="w-full bg-transparent outline-none placeholder:text-[#9aa1bd]" placeholder="Cari data..." aria-label="Cari data">
                        </label>
                        <button type="button" class="grid h-10 w-10 place-items-center rounded-xl text-[#4c35d8] hover:bg-[#f1efff]" aria-label="Notifikasi">♧</button>
                        <span class="grid h-9 w-9 place-items-center rounded-full bg-[#e0f3e7] text-xs font-bold text-[#248a50]">AE</span>
                    </div>
                </header>

                <div class="mx-auto max-w-[1440px] p-5 sm:p-8">
                    <section class="mb-6 flex flex-col justify-between gap-5 xl:flex-row xl:items-center">
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">Ringkasan Presensi Ekstrakurikuler</h2>
                            <p class="mt-1 text-sm text-[#667099]">Monitoring kehadiran digital IT Club SMK Negeri 1 Jakarta secara langsung.</p>
                        </div>
                        <div class="grid grid-cols-2 gap-2 sm:flex">
                            <button type="button" class="min-h-11 rounded-xl bg-[#eeecff] px-4 text-xs font-bold text-[#4435ba] hover:bg-[#e4e0ff]">Tambah Anggota</button>
                            <button type="button" class="min-h-11 rounded-xl bg-[#eeecff] px-4 text-xs font-bold text-[#4435ba] hover:bg-[#e4e0ff]">Pengaturan Lokasi</button>
                            <button type="button" class="col-span-2 min-h-11 rounded-xl bg-[#5638e4] px-5 text-xs font-bold text-white shadow-lg shadow-[#5638e4]/20 hover:bg-[#4428c5]">Buat Pertemuan</button>
                        </div>
                    </section>

                    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Ringkasan statistik">
                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]"><p class="text-[11px] font-bold tracking-wide text-[#70789e]">ANGGOTA AKTIF</p><div class="mt-2 flex items-end justify-between"><strong class="text-3xl">40</strong><span class="grid h-10 w-10 place-items-center rounded-xl bg-[#f0efff] text-[#5138e6]">♧</span></div><p class="mt-1 text-xs text-[#8a91b0]">Total siswa terdaftar</p></article>
                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]"><p class="text-[11px] font-bold tracking-wide text-[#70789e]">TOTAL PERTEMUAN</p><div class="mt-2 flex items-end justify-between"><strong class="text-3xl">12</strong><span class="grid h-10 w-10 place-items-center rounded-xl bg-[#f0efff] text-[#5138e6]">□</span></div><p class="mt-1 text-xs text-[#8a91b0]">Semester ganjil berjalan</p></article>
                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]"><p class="text-[11px] font-bold tracking-wide text-[#70789e]">SESI DIBUKA</p><div class="mt-2 flex items-end justify-between"><strong class="text-3xl">1</strong><span class="rounded-full bg-[#ddf9e9] px-2 py-1 text-[10px] font-bold text-[#168349]">Aktif</span></div><p class="mt-1 text-xs text-[#8a91b0]">Pertemuan aktif sekarang</p></article>
                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]"><p class="text-[11px] font-bold tracking-wide text-[#70789e]">RATA-RATA HADIR</p><div class="mt-2 flex items-end justify-between"><strong class="text-3xl">82%</strong><span class="text-xs font-bold text-[#2e70e8]">+ 3%</span></div><p class="mt-1 text-xs text-[#8a91b0]">Dibandingkan bulan lalu</p></article>
                    </section>

                    <section class="mt-5 rounded-2xl bg-gradient-to-r from-[#2259df] to-[#7137e8] p-5 text-white shadow-lg shadow-[#4b39d8]/20 sm:p-7">
                        <div class="flex flex-col justify-between gap-4 md:flex-row"><div><p class="text-xs font-bold text-[#d7d5ff]">SESI PRESENSI AKTIF · PERTEMUAN KE-12</p><h3 class="mt-2 text-2xl font-bold">Dasar Laravel & Routing Web API</h3><p class="mt-2 text-sm text-[#ecebff]">Lab Komputer 2, Gedung B, Lt. 3 · 15.00 - 17.00 WIB · Radius validasi: 50 meter</p></div><div class="flex items-start"><button type="button" class="min-h-10 rounded-xl bg-white px-6 text-sm font-bold text-[#5638e4] hover:bg-[#f1f0ff]">Tutup Sesi</button></div></div>
                        <div class="mt-6 grid gap-2 text-xs font-semibold sm:grid-cols-[1fr_auto]"><div><div class="mb-2 flex justify-between"><span>Progres Kehadiran Siswa</span><span>27 dari 40 Siswa (67.5%)</span></div><div class="h-2 rounded-full bg-white/30"><div class="h-2 w-2/3 rounded-full bg-white"></div></div></div></div>
                    </section>

                    <section class="mt-5 grid gap-5 xl:grid-cols-[1fr_320px]">
                        <article id="absensi" class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#eef0f8]"><div class="flex items-start justify-between p-5"><div><h3 class="font-bold">Absensi Terbaru <span class="ml-1 rounded-md bg-[#e9ecff] px-2 py-1 text-[10px] text-[#3159dc]">Live Stream</span></h3><p class="mt-1 text-xs text-[#7a82a8]">Daftar siswa yang baru saja melakukan submit presensi lokasi & swafoto</p></div><button type="button" class="text-xs font-bold text-[#4e39d8]">Filter</button></div><div class="overflow-x-auto"><table class="w-full min-w-[670px] text-left text-xs"><thead class="bg-[#f6f7fc] text-[10px] tracking-wide text-[#70789e]"><tr><th class="px-5 py-3">SISWA</th><th class="px-3 py-3">WAKTU</th><th class="px-3 py-3">STATUS</th><th class="px-3 py-3">JARAK GPS</th><th class="px-5 py-3">SWAFOTO</th></tr></thead><tbody class="divide-y divide-[#eef0f8]"><tr><td class="px-5 py-4 font-bold">Budi Santoso <span class="block pt-1 text-[10px] font-normal text-[#8a91b0]">202310114 · XI PPLG 1</span></td><td class="px-3 py-4 font-bold">15.03 WIB <span class="block pt-1 text-[10px] font-normal text-[#238952]">Tepat Waktu</span></td><td class="px-3 py-4"><span class="rounded-full bg-[#ddf9e9] px-3 py-1 font-bold text-[#13824a]">Hadir</span></td><td class="px-3 py-4">12 meter <span class="block pt-1 text-[10px] text-[#238952]">Dalam Zona Lab</span></td><td class="px-5 py-4"><button type="button" class="rounded-lg bg-[#eef0ff] px-2 py-1 text-[#5138e6]" aria-label="Lihat swafoto Budi Santoso">▣</button></td></tr><tr><td class="px-5 py-4 font-bold">Siti Rahma <span class="block pt-1 text-[10px] font-normal text-[#8a91b0]">202310189 · XI PPLG 2</span></td><td class="px-3 py-4 font-bold">15.06 WIB <span class="block pt-1 text-[10px] font-normal text-[#238952]">Tepat Waktu</span></td><td class="px-3 py-4"><span class="rounded-full bg-[#ddf9e9] px-3 py-1 font-bold text-[#13824a]">Hadir</span></td><td class="px-3 py-4">24 meter <span class="block pt-1 text-[10px] text-[#238952]">Dalam Zona Lab</span></td><td class="px-5 py-4"><button type="button" class="rounded-lg bg-[#eef0ff] px-2 py-1 text-[#5138e6]" aria-label="Lihat swafoto Siti Rahma">▣</button></td></tr><tr><td class="px-5 py-4 font-bold">Ahmad Fauzi <span class="block pt-1 text-[10px] font-normal text-[#8a91b0]">202310204 · XI TKJ 1</span></td><td class="px-3 py-4 font-bold text-[#e78a28]">15.22 WIB <span class="block pt-1 text-[10px] font-normal">+22 Menit</span></td><td class="px-3 py-4"><span class="rounded-full bg-[#fff0d7] px-3 py-1 font-bold text-[#cc7519]">Terlambat</span></td><td class="px-3 py-4">38 meter <span class="block pt-1 text-[10px] text-[#238952]">Dalam Zona Lab</span></td><td class="px-5 py-4"><button type="button" class="rounded-lg bg-[#eef0ff] px-2 py-1 text-[#5138e6]" aria-label="Lihat swafoto Ahmad Fauzi">▣</button></td></tr></tbody></table></div><div class="flex justify-between px-5 py-5 text-xs text-[#7a82a8]"><span>Menampilkan 3 dari 27 data kehadiran hari ini</span><a href="#rekap" class="font-bold text-[#4935d4] hover:underline">Lihat Semua Presensi</a></div></article>
                        <aside id="rekap" class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]"><h3 class="font-bold">Tren 5 Pertemuan</h3><p class="mt-1 text-xs text-[#7a82a8]">Persentase kehadiran materi ekskul</p><div class="mt-5 space-y-4 text-xs font-semibold"><div><div class="mb-1 flex justify-between"><span>P8 · Database Migration</span><span>85%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[85%] rounded-full bg-[#185cda]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P9 · API Integration</span><span>78%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[78%] rounded-full bg-[#185cda]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P10 · Git & Team</span><span>90%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[90%] rounded-full bg-[#5d35df]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P11 · PHP Syntax</span><span>88%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[88%] rounded-full bg-[#185cda]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P12 · Dasar Laravel</span><span class="text-[#633cf0]">68%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[68%] rounded-full bg-[#6d38e6]"></div></div></div></div><div class="mt-7 grid grid-cols-2 gap-3 rounded-xl bg-[#f0f1ff] p-4"><div><p class="text-[9px] font-bold text-[#6972a2]">STANDAR MINIMAL</p><p class="mt-1 text-lg font-bold">75.0%</p></div><div><p class="text-[9px] font-bold text-[#6972a2]">STATUS KELAYAKAN</p><p class="mt-1 text-xs font-bold text-[#1d9153]">Memenuhi Kuota</p></div></div></aside>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
