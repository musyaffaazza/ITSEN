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
            <aside class="sticky top-0 h-screen hidden border-r border-[#e7e9f4] bg-white lg:flex lg:flex-col">
                <div class="flex h-[72px] items-center gap-3 border-b border-[#e7e9f4] px-7">
                    <img src="{{ asset('images/logo-it.jpeg') }}" alt="Logo ITSEN" width="36" height="36" class="h-9 w-9 rounded-xl object-cover">
                    <div>
                        <p class="font-bold leading-tight">ITSEN</p>
                        <p class="text-[11px] text-[#7a82a8]">Admin Portal</p>
                    </div>
                </div>

                @include('components.admin.sidebar', ['active' => 'dashboard'])

                <x-admin.footer />
            </aside>

            <main id="dashboard">
                <x-admin.header title="Dashboard" />

                <div class="mx-auto max-w-[1440px] px-5 py-8 sm:px-8 sm:py-10">
                    <section class="mb-5 flex flex-col justify-between gap-5 xl:flex-row xl:items-center">
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">Ringkasan Presensi Ekstrakurikuler</h2>
                            <p class="mt-1 text-sm text-[#667099]">Monitoring kehadiran digital IT Club SMK Negeri 1 Gunungputri secara langsung.</p>
                        </div>
                    </section>

                    <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4" aria-label="Ringkasan statistik">
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
                        <article id="absensi" class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#eef0f8]"><div class="flex items-start justify-between p-5"><div><h3 class="font-bold">Absensi Terbaru <span class="ml-1 rounded-md bg-[#e9ecff] px-2 py-1 text-[10px] text-[#3159dc]">Live Stream</span></h3><p class="mt-1 text-xs text-[#7a82a8]">Daftar siswa yang baru saja melakukan submit presensi lokasi & swafoto</p></div><button type="button" class="text-xs font-bold text-[#4e39d8]">Filter</button></div><div class="overflow-x-auto"><table class="w-full min-w-[670px] text-left text-xs"><thead class="bg-[#f6f7fc] text-[10px] tracking-wide text-[#70789e]"><tr><th class="px-5 py-3">NAMA ANGGOTA</th><th class="px-3 py-3">KELAS</th><th class="px-3 py-3">WAKTU</th><th class="px-3 py-3">STATUS</th><th class="px-3 py-3">JARAK GPS</th><th class="px-5 py-3">SWAFOTO</th></tr></thead><tbody class="divide-y divide-[#eef0f8]"><tr><td class="px-5 py-4"><div class="flex items-center gap-3"><span class="grid h-8 w-8 place-items-center rounded-full bg-[#e7edff] text-[10px] font-bold text-[#3159dc]">BS</span><div><b>Budi Santoso</b><small class="block text-[10px] text-[#7a82a8]">NIT: 20260001</small></div></div></td><td class="px-3 py-4"><span class="rounded-md bg-[#e9ecff] px-2 py-1 text-[10px] font-semibold text-[#4057c5]">XI PPLG 1</span></td><td class="px-3 py-4 font-bold">15.03 WIB <span class="block pt-1 text-[10px] font-normal text-[#238952]">Tepat Waktu</span></td><td class="px-3 py-4"><span class="rounded-full bg-[#ddf9e9] px-3 py-1 font-bold text-[#13824a]">Hadir</span></td><td class="px-3 py-4">12 meter <span class="block pt-1 text-[10px] text-[#238952]">Dalam Zona Lab</span></td><td class="px-5 py-4"><button type="button" class="rounded-lg bg-[#eef0ff] px-2 py-1 text-[#5138e6]" aria-label="Lihat swafoto Budi Santoso">▣</button></td></tr><tr><td class="px-5 py-4"><div class="flex items-center gap-3"><span class="grid h-8 w-8 place-items-center rounded-full bg-[#f0e5ff] text-[10px] font-bold text-[#7137d7]">SR</span><div><b>Siti Rahma</b><small class="block text-[10px] text-[#7a82a8]">NIT: 20260002</small></div></div></td><td class="px-3 py-4"><span class="rounded-md bg-[#e9ecff] px-2 py-1 text-[10px] font-semibold text-[#4057c5]">XI PPLG 2</span></td><td class="px-3 py-4 font-bold">15.06 WIB <span class="block pt-1 text-[10px] font-normal text-[#238952]">Tepat Waktu</span></td><td class="px-3 py-4"><span class="rounded-full bg-[#ddf9e9] px-3 py-1 font-bold text-[#13824a]">Hadir</span></td><td class="px-3 py-4">24 meter <span class="block pt-1 text-[10px] text-[#238952]">Dalam Zona Lab</span></td><td class="px-5 py-4"><button type="button" class="rounded-lg bg-[#eef0ff] px-2 py-1 text-[#5138e6]" aria-label="Lihat swafoto Siti Rahma">▣</button></td></tr><tr><td class="px-5 py-4"><div class="flex items-center gap-3"><span class="grid h-8 w-8 place-items-center rounded-full bg-[#e7edff] text-[10px] font-bold text-[#3159dc]">AF</span><div><b>Ahmad Fauzi</b><small class="block text-[10px] text-[#7a82a8]">NIT: 20260003</small></div></div></td><td class="px-3 py-4"><span class="rounded-md bg-[#e9ecff] px-2 py-1 text-[10px] font-semibold text-[#4057c5]">XI TKJ 1</span></td><td class="px-3 py-4 font-bold text-[#e78a28]">15.22 WIB <span class="block pt-1 text-[10px] font-normal">+22 Menit</span></td><td class="px-3 py-4"><span class="rounded-full bg-[#fff0d7] px-3 py-1 font-bold text-[#cc7519]">Terlambat</span></td><td class="px-3 py-4">38 meter <span class="block pt-1 text-[10px] text-[#238952]">Dalam Zona Lab</span></td><td class="px-5 py-4"><button type="button" class="rounded-lg bg-[#eef0ff] px-2 py-1 text-[#5138e6]" aria-label="Lihat swafoto Ahmad Fauzi">▣</button></td></tr></tbody></table></div><div class="flex justify-between px-5 py-5 text-xs text-[#7a82a8]"><span>Menampilkan 3 dari 27 data kehadiran hari ini</span><a href="/rekap" class="font-bold text-[#4935d4] hover:underline">Lihat Semua Presensi</a></div></article>
                        <aside id="rekap" class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]"><h3 class="font-bold">Tren 5 Pertemuan</h3><p class="mt-1 text-xs text-[#7a82a8]">Persentase kehadiran materi ekskul</p><div class="mt-5 space-y-4 text-xs font-semibold"><div><div class="mb-1 flex justify-between"><span>P8 · Database Migration</span><span>85%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[85%] rounded-full bg-[#185cda]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P9 · API Integration</span><span>78%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[78%] rounded-full bg-[#185cda]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P10 · Git & Team</span><span>90%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[90%] rounded-full bg-[#5d35df]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P11 · PHP Syntax</span><span>88%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[88%] rounded-full bg-[#185cda]"></div></div></div><div><div class="mb-1 flex justify-between"><span>P12 · Dasar Laravel</span><span class="text-[#633cf0]">68%</span></div><div class="h-2 rounded-full bg-[#e9ebf5]"><div class="h-2 w-[68%] rounded-full bg-[#6d38e6]"></div></div></div></div></aside>
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
