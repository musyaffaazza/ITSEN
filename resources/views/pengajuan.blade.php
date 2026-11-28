<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengajuan Izin / Sakit | ITSEN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f8f8fd] font-sans text-[#172044]">
<div class="min-h-screen lg:grid lg:grid-cols-[250px_1fr]">
    <aside class="sticky top-0 h-screen hidden border-r border-[#e7e9f4] bg-white lg:flex lg:flex-col">
        <div class="flex h-[72px] items-center gap-3 border-b border-[#e7e9f4] px-7">
            <img src="{{ asset('images/logo-it.jpeg') }}" alt="Logo ITSEN" width="36" height="36" class="h-9 w-9 rounded-xl object-cover">
            <div>
                <p class="font-bold leading-tight">ITSEN</p>
                <p class="text-[11px] text-[#7a82a8]">Admin Portal</p>
            </div>
        </div>
        @include('components.admin.sidebar', ['active' => 'pengajuan'])
        <x-admin.footer />
    </aside>

    <main>
        <x-admin.header title="Pengajuan" />

        <div class="mx-auto max-w-[1440px] px-5 py-8 sm:px-8 sm:py-10">
            <!-- Top Bar: Title & Action -->
            <section class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <h1 class="mt-2 text-2xl font-bold tracking-tight">Pengajuan Izin / Sakit</h1>
                    <p class="mt-1 text-sm text-[#667099]">Kelola dan verifikasi permohonan ketidakhadiran siswa ekstrakurikuler IT Club.</p>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" class="flex min-h-11 items-center gap-2 rounded-xl border border-[#e1e3ef] bg-white px-4 text-xs font-bold text-[#536084] shadow-xs hover:bg-[#f6f7fc] transition">
                        <span>↶</span>
                        <span>Riwayat Verifikasi</span>
                    </button>
                    <button type="button" class="flex min-h-11 items-center gap-2 rounded-xl bg-[#1554d6] px-5 text-xs font-bold text-white shadow-md shadow-[#1554d6]/20 hover:bg-[#1146b5] transition">
                        <span>↓</span>
                        <span>Unduh Rekap</span>
                    </button>
                </div>
            </section>

            <!-- Stat Cards -->
            <section class="mt-6 grid gap-4 sm:grid-cols-3">
                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold tracking-wider uppercase text-[#667099]">MENUNGGU VERIFIKASI</p>
                            <strong class="mt-2 block text-3xl font-extrabold text-[#172044]">3 <small class="text-xs font-normal text-[#7a82a8]">Permohonan</small></strong>
                            <p class="mt-1 text-[10px] font-semibold text-[#d98518]">⊙ Perlu tindak lanjut segera</p>
                        </div>
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#fff0bf] text-xl text-[#d98518]">◷</span>
                    </div>
                </article>

                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold tracking-wider uppercase text-[#667099]">DISETUJUI BULAN INI</p>
                            <strong class="mt-2 block text-3xl font-extrabold text-[#168349]">18 <small class="text-xs font-normal text-[#7a82a8]">Siswa</small></strong>
                            <p class="mt-1 text-[10px] font-semibold text-[#168349]">⊙ Presensi otomatis terbaru</p>
                        </div>
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#ddf9e9] text-xl text-[#168349]">✓</span>
                    </div>
                </article>

                <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold tracking-wider uppercase text-[#667099]">DITOLAK BULAN INI</p>
                            <strong class="mt-2 block text-3xl font-extrabold text-[#d94354]">2 <small class="text-xs font-normal text-[#7a82a8]">Permohonan</small></strong>
                            <p class="mt-1 text-[10px] font-semibold text-[#d94354]">⊗ Status tetap Alpa</p>
                        </div>
                        <span class="grid h-11 w-11 place-items-center rounded-2xl bg-[#ffe3e3] text-xl text-[#d94354]">⊘</span>
                    </div>
                </article>
            </section>

            <!-- Info System -->
            <aside class="mt-5 flex items-center gap-2 rounded-2xl bg-[#eef3ff] p-4 text-xs text-[#536084] ring-1 ring-[#d8e3ff]">
                <span class="font-bold text-[#3159c8]">ⓘ Informasi Sistem:</span>
                <span>Pengajuan yang disetujui akan otomatis mengubah status absensi siswa menjadi <b class="text-[#172044]">Izin</b> atau <b class="text-[#172044]">Sakit</b> pada rekapitulasi kehadiran pertemuan terkait.</span>
            </aside>

            <!-- Filter Card (Card Pencarian) -->
            <section class="mt-5 w-full rounded-2xl bg-white p-3.5 shadow-sm ring-1 ring-[#eef0f8]">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
                    <div class="flex gap-1.5 shrink-0">
                        <button type="button" class="rounded-xl bg-[#eef1ff] px-4 py-2.5 text-xs font-bold text-[#4057c5] shadow-xs">
                            Menunggu <span class="ml-1 rounded-full bg-[#fff0bf] px-1.5 py-0.5 text-[10px] font-extrabold text-[#b46b0a]">3</span>
                        </button>
                        <button type="button" class="rounded-xl px-4 py-2.5 text-xs font-medium text-[#667099] hover:bg-[#f6f7fc] transition">
                            Disetujui <span class="ml-1 rounded-full bg-[#eef0f8] px-1.5 py-0.5 text-[10px] text-[#7a82a8]">18</span>
                        </button>
                        <button type="button" class="rounded-xl px-4 py-2.5 text-xs font-medium text-[#667099] hover:bg-[#f6f7fc] transition">
                            Ditolak <span class="ml-1 rounded-full bg-[#eef0f8] px-1.5 py-0.5 text-[10px] text-[#7a82a8]">2</span>
                        </button>
                    </div>
                    <select class="min-h-11 rounded-xl border border-[#e5e7f1] bg-[#f0f2ff] px-3.5 text-xs font-medium text-[#3e4b78] outline-none focus:border-[#5638e4] lg:w-72" aria-label="Pilih sesi pertemuan">
                        <option>Pertemuan 13: Database - Jumat, 27 Nov</option>
                        <option>Semua Pertemuan</option>
                    </select>
                    <label class="flex min-h-11 flex-1 items-center gap-2 rounded-xl border border-[#e5e7f1] bg-[#f0f2ff] px-3.5 text-xs text-[#7a82a8] focus-within:border-[#5638e4]">
                        <span>⌕</span>
                        <input type="search" class="w-full bg-transparent outline-none placeholder:text-[#9aa1bd]" placeholder="Cari nama siswa atau NIT..." aria-label="Cari pengajuan">
                    </label>
                    <button type="button" class="flex min-h-11 items-center justify-center gap-2 rounded-xl bg-[#eef1ff] px-5 text-xs font-bold text-[#4057c5] hover:bg-[#e2e7ff] transition shrink-0">
                        <span>☷</span>
                        <span>Filter Lanjutan</span>
                    </button>
                </div>
            </section>

            <!-- Table Section (Full Width matching Filter Card) -->
            <section class="mt-5 w-full overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#eef0f8]">
                <div class="flex items-center justify-between border-b border-[#eef0f8] px-6 py-5">
                    <div>
                        <h2 class="text-base font-bold text-[#172044]">Daftar Pengajuan <span class="text-xs font-normal text-[#667099]">• Menunggu Konfirmasi</span></h2>
                        <p class="mt-0.5 text-xs text-[#7a82a8]">Verifikasi bukti surat dispensasi atau keterangan sakit siswa ekstrakurikuler.</p>
                    </div>
                    <button type="button" class="grid h-8 w-8 place-items-center rounded-lg border border-[#e1e4ef] text-sm text-[#4057c5] hover:bg-[#f0f2ff] transition" aria-label="Muat ulang daftar" title="Muat ulang data">↻</button>
                </div>

                <div class="w-full overflow-x-auto">
                    <table class="w-full min-w-[1020px] text-left text-xs">
                        <thead class="bg-[#f4f5fd] text-[10px] font-bold tracking-wider uppercase text-[#667099]">
                            <tr>
                                <th class="w-[20%] px-6 py-4">NAMA ANGGOTA</th>
                                <th class="w-[10%] px-4 py-4">KELAS</th>
                                <th class="w-[18%] px-4 py-4">SESI PERTEMUAN</th>
                                <th class="w-[10%] px-4 py-4">JENIS</th>
                                <th class="w-[20%] px-4 py-4">ALASAN & BUKTI</th>
                                <th class="w-[11%] px-4 py-4">WAKTU DIAJUKAN</th>
                                <th class="w-[8%] px-4 py-4">STATUS</th>
                                <th class="w-[3%] px-5 py-4 text-right">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#eef0f8]">
                            <!-- Row 1: Ahmad Dahlan -->
                            <tr tabindex="0" role="link" data-detail-url="/pengajuan/1" class="cursor-pointer transition hover:bg-[#f8f8ff] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#5638e4]">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[#e0e8ff] text-xs font-bold text-[#3159dc]">AD</span>
                                        <div>
                                            <b class="text-xs font-bold text-[#172044]">Ahmad Dahlan</b>
                                            <small class="block text-[11px] text-[#7a82a8]">NIT: 20260001</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="rounded-md bg-[#e9ecff] px-2.5 py-1 text-[11px] font-semibold text-[#4057c5]">XI PPLG 1</span>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="font-semibold text-[#172044]">Pertemuan 13: Database & MySQL</p>
                                    <small class="block text-[11px] text-[#7a82a8]">Jumat, 27 Nov 2026 · 15.00 WIB</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-[#e7f1ff] px-3 py-1 text-[11px] font-semibold text-[#3369d2]">
                                        <span>✉</span>
                                        <span>Izin</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="text-xs text-[#3e4b78] line-clamp-1">Mengikuti olimpiade sains terapan tingkat kota mewakili sekolah di SMKN 1 Surabaya.</p>
                                    <span class="mt-1 inline-flex items-center gap-1 text-[10px] font-semibold text-[#4057c5]">
                                        <span>📎</span>
                                        <span>Surat Dispensasi.pdf</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-[#536084]">
                                    <p class="font-medium text-[#172044]">26 Nov 2026</p>
                                    <small class="block text-[11px] text-[#7a82a8]">12:42 WIB</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-[#fff0bf] px-2.5 py-1 text-[11px] font-bold text-[#b46b0a]">
                                        <span>◷</span>
                                        <span>Menunggu</span>
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <a href="/pengajuan/1" class="inline-flex items-center gap-1 rounded-xl border border-[#e1e4ef] bg-white px-3 py-1.5 text-xs font-bold text-[#4057c5] shadow-xs transition hover:border-[#5638e4] hover:bg-[#f0edff] hover:text-[#5638e4]">
                                        <span>Tinjau</span>
                                        <span class="text-[10px]">→</span>
                                    </a>
                                </td>
                            </tr>

                            <!-- Row 2: Farhan Maulana -->
                            <tr tabindex="0" role="link" data-detail-url="/pengajuan/1" class="cursor-pointer transition hover:bg-[#f8f8ff] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#5638e4]">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[#f0e5ff] text-xs font-bold text-[#7137d7]">FM</span>
                                        <div>
                                            <b class="text-xs font-bold text-[#172044]">Farhan Maulana</b>
                                            <small class="block text-[11px] text-[#7a82a8]">NIT: 20260002</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="rounded-md bg-[#e9ecff] px-2.5 py-1 text-[11px] font-semibold text-[#4057c5]">XI TKJ 1</span>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="font-semibold text-[#172044]">Pertemuan 13: Database & MySQL</p>
                                    <small class="block text-[11px] text-[#7a82a8]">Jumat, 27 Nov 2026 · 15.00 WIB</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-[#f0e5ff] px-3 py-1 text-[11px] font-semibold text-[#7137d7]">
                                        <span>⊕</span>
                                        <span>Sakit</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="text-xs text-[#3e4b78] line-clamp-1">Demam tinggi dan flu sejak pagi hari, dianjurkan dokter beristirahat 2 hari.</p>
                                    <span class="mt-1 inline-flex items-center gap-1 text-[10px] font-semibold text-[#4057c5]">
                                        <span>📎</span>
                                        <span>Surat Dokter.pdf</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-[#536084]">
                                    <p class="font-medium text-[#172044]">26 Nov 2026</p>
                                    <small class="block text-[11px] text-[#7a82a8]">14:15 WIB</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-[#fff0bf] px-2.5 py-1 text-[11px] font-bold text-[#b46b0a]">
                                        <span>◷</span>
                                        <span>Menunggu</span>
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <a href="/pengajuan/1" class="inline-flex items-center gap-1 rounded-xl border border-[#e1e4ef] bg-white px-3 py-1.5 text-xs font-bold text-[#4057c5] shadow-xs transition hover:border-[#5638e4] hover:bg-[#f0edff] hover:text-[#5638e4]">
                                        <span>Tinjau</span>
                                        <span class="text-[10px]">→</span>
                                    </a>
                                </td>
                            </tr>

                            <!-- Row 3: Citra Amanda -->
                            <tr tabindex="0" role="link" data-detail-url="/pengajuan/1" class="cursor-pointer transition hover:bg-[#f8f8ff] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#5638e4]">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[#e0e8ff] text-xs font-bold text-[#3159dc]">CA</span>
                                        <div>
                                            <b class="text-xs font-bold text-[#172044]">Citra Amanda</b>
                                            <small class="block text-[11px] text-[#7a82a8]">NIT: 20260003</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="rounded-md bg-[#e9ecff] px-2.5 py-1 text-[11px] font-semibold text-[#4057c5]">XI PPLG 2</span>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="font-semibold text-[#172044]">Pertemuan 13: Database & MySQL</p>
                                    <small class="block text-[11px] text-[#7a82a8]">Jumat, 27 Nov 2026 · 15.00 WIB</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-[#e7f1ff] px-3 py-1 text-[11px] font-semibold text-[#3369d2]">
                                        <span>✉</span>
                                        <span>Izin</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="text-xs text-[#3e4b78] line-clamp-1">Keperluan keluarga mendesak ke luar kota bersama orang tua.</p>
                                    <span class="mt-1 inline-flex items-center gap-1 text-[10px] font-semibold text-[#4057c5]">
                                        <span>📎</span>
                                        <span>Surat Izin Orang Tua.pdf</span>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-[#536084]">
                                    <p class="font-medium text-[#172044]">27 Nov 2026</p>
                                    <small class="block text-[11px] text-[#7a82a8]">08:30 WIB</small>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-[#fff0bf] px-2.5 py-1 text-[11px] font-bold text-[#b46b0a]">
                                        <span>◷</span>
                                        <span>Menunggu</span>
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <a href="/pengajuan/1" class="inline-flex items-center gap-1 rounded-xl border border-[#e1e4ef] bg-white px-3 py-1.5 text-xs font-bold text-[#4057c5] shadow-xs transition hover:border-[#5638e4] hover:bg-[#f0edff] hover:text-[#5638e4]">
                                        <span>Tinjau</span>
                                        <span class="text-[10px]">→</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Single Clean Pagination Footer -->
                <footer class="flex flex-col gap-3 border-t border-[#eef0f8] px-6 py-4 text-xs text-[#667099] sm:flex-row sm:items-center sm:justify-between">
                    <span>Menampilkan <b>1 - 3</b> dari <b>3</b> permohonan menunggu konfirmasi</span>
                    <nav class="flex items-center gap-1" aria-label="Pagination">
                        <button type="button" disabled aria-label="Halaman sebelumnya" class="grid h-9 min-w-9 cursor-not-allowed place-items-center rounded-lg border border-[#e4e6f0] px-2 text-[#9aa1bd]">‹</button>
                        <button type="button" disabled aria-current="page" class="grid h-9 min-w-9 cursor-not-allowed place-items-center rounded-lg bg-[#eef1ff] px-2 font-bold text-[#4057c5]">1</button>
                        <button type="button" disabled aria-label="Halaman berikutnya" class="grid h-9 min-w-9 cursor-not-allowed place-items-center rounded-lg border border-[#e4e6f0] px-2 text-[#9aa1bd]">›</button>
                    </nav>
                </footer>
            </section>
        </div>
    </main>
</div>

<script>
    document.querySelectorAll('tr[data-detail-url]').forEach((row) => {
        row.addEventListener('click', (event) => {
            if (!event.target.closest('button, a, input, select, textarea')) {
                window.location.href = row.dataset.detailUrl;
            }
        });
        row.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                window.location.href = row.dataset.detailUrl;
            }
        });
    });
</script>
</body>
</html>
