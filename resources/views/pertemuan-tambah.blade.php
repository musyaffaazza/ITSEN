<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Pertemuan | ITSEN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f8f8fd] font-sans text-[#172044]">
<div class="min-h-screen lg:grid lg:grid-cols-[250px_1fr]">
    <aside class="sticky top-0 h-screen hidden border-r border-[#e7e9f4] bg-white lg:flex lg:flex-col">
        <div class="flex h-[72px] items-center gap-3 border-b border-[#e7e9f4] px-7">
            <img src="{{ asset('images/logo-it.jpeg') }}" alt="Logo ITSEN" width="36" height="36" class="h-9 w-9 rounded-xl object-cover">
            <div><p class="font-bold">ITSEN</p><p class="text-[11px] text-[#7a82a8]">Admin Portal</p></div>
        </div>
        @include('components.admin.sidebar', ['active' => 'pertemuan'])
        <x-admin.footer />
    </aside>
    <main>
        <x-admin.header title="Buat Pertemuan" />
        <div class="mx-auto max-w-[1440px] px-5 py-8 sm:px-8 sm:py-10">
            <div class="mb-6 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <p class="text-xs text-[#5364c7]"><a href="/pertemuan" class="hover:underline">Pertemuan</a> &nbsp;›&nbsp; Buat Sesi Baru</p>
                    <h1 class="mt-2 text-2xl font-bold">Buat Pertemuan Baru</h1>
                    <p class="mt-1 text-sm text-[#667099]">Jadwalkan materi pembelajaran, tentukan batas waktu toleransi, dan siapkan sesi presensi IT Club.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-[#ffc8cf] bg-[#fff4f5] p-4 text-sm text-[#b42f47]">
                    <p class="font-bold">Data belum dapat disimpan.</p>
                    <ul class="mt-2 list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="/pertemuan" method="post" class="overflow-hidden rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#e7e9f4] sm:p-7">
                @csrf
                <div class="mb-6 flex gap-3 rounded-xl bg-[#eef1ff] p-4">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-[#2963e5] font-bold text-white">≡</span>
                    <div>
                        <p class="text-sm font-bold text-[#2c4eb3]">Konfigurasi Parameter Presensi</p>
                        <p class="text-xs text-[#536084]">Sistem batasan toleransi waktu dan presensi lokasi akan langsung aktif saat sesi dimulai.</p>
                    </div>
                </div>
                <div class="space-y-5">
                    <div>
                        <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                            <label for="judul" class="text-xs font-bold text-[#172044]">
                                Judul Pertemuan <span class="text-[#e24c65]">*</span>
                            </label>
                            <div class="flex items-center gap-1.5 text-[11px]">
                                <span class="text-[#7a82a8]">Gunakan Template:</span>
                                <button type="button" onclick="setTemplate('Pertemuan {{ $nextNum ?? 15 }}: ')" class="inline-flex items-center gap-1 rounded-lg border border-[#d6e3fc] bg-[#f0f4ff] px-2.5 py-1 font-bold text-[#1e58d8] hover:bg-[#e0ecff] transition shadow-2xs" title="Gunakan template Pertemuan {{ $nextNum ?? 15 }}:">
                                    <span>Pertemuan {{ $nextNum ?? 15 }}:</span>
                                </button>
                                <button type="button" onclick="setTemplate('Pertemuan -: ')" class="inline-flex items-center gap-1 rounded-lg border border-[#e1e4ef] bg-[#f8f9ff] px-2.5 py-1 font-bold text-[#536084] hover:bg-[#edf0fa] transition shadow-2xs" title="Gunakan template Pertemuan -:">
                                    <span>Pertemuan -:</span>
                                </button>
                            </div>
                        </div>
                        <input id="judul" name="judul" required maxlength="150" 
                            value="{{ old('judul', $defaultJudul ?? ('Pertemuan ' . ($nextNum ?? 15) . ': ')) }}" 
                            placeholder="Contoh: Pertemuan {{ $nextNum ?? 15 }}: Dasar Laravel & Routing Web API" 
                            class="min-h-11 w-full rounded-xl border border-[#e1e4ef] bg-[#f8f9ff] px-4 text-sm font-medium text-[#172044] outline-none focus:border-[#1554d6] focus:bg-white transition">
                        <p class="mt-2 text-[10px] text-[#7a82a8]">Format template: <b>Pertemuan {{ $nextNum ?? 15 }}: [Materi]</b> atau <b>Pertemuan -: [Materi]</b>. Nomor dan materi dapat Anda sesuaikan langsung di kolom judul.</p>
                    </div>
                    <div>
                        <label for="tanggal" class="mb-2 block text-xs font-bold">Tanggal Pertemuan <span class="text-[#e24c65]">*</span></label>
                        <input id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', date('Y-m-d')) }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] bg-[#f8f9ff] px-4 text-sm outline-none focus:border-[#5638e4]">
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="jam_mulai" class="mb-2 block text-xs font-bold">Jam Mulai <span class="text-[#e24c65]">*</span></label>
                            <input id="jam_mulai" name="jam_mulai" type="time" value="{{ old('jam_mulai', '15:00') }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] bg-[#f8f9ff] px-4 text-sm outline-none focus:border-[#5638e4]">
                        </div>
                        <div>
                            <label for="jam_selesai" class="mb-2 block text-xs font-bold">Jam Selesai <span class="text-[#e24c65]">*</span></label>
                            <input id="jam_selesai" name="jam_selesai" type="time" value="{{ old('jam_selesai', '17:00') }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] bg-[#f8f9ff] px-4 text-sm outline-none focus:border-[#5638e4]">
                        </div>
                    </div>
                    <div>
                        <label for="toleransi_menit" class="mb-2 block text-xs font-bold">Toleransi Keterlambatan (Menit) <span class="text-[#e24c65]">*</span></label>
                        <div class="flex items-center rounded-xl border border-[#e1e4ef] bg-[#f8f9ff] px-4">
                            <span class="text-[#7a82a8]">◷</span>
                            <input id="toleransi_menit" name="toleransi_menit" type="number" min="0" max="120" value="{{ old('toleransi_menit', 15) }}" required class="min-h-11 w-full bg-transparent px-3 text-sm outline-none">
                            <span class="text-xs text-[#536084]">Menit</span>
                        </div>
                        <p class="mt-2 text-[10px] text-[#7a82a8]">Absen setelah batas waktu toleransi ini akan otomatis tercatat sebagai Terlambat.</p>
                    </div>
                    <div>
                        <label for="catatan" class="mb-2 block text-xs font-bold">Catatan / Instruksi Sesi <span class="font-normal text-[#7a82a8]">(Opsional)</span></label>
                        <textarea id="catatan" name="catatan" rows="3" class="w-full rounded-xl border border-[#e1e4ef] bg-[#f8f9ff] px-4 py-3 text-sm outline-none focus:border-[#5638e4]" placeholder="Tulis instruksi, modul, atau persiapan untuk anggota...">{{ old('catatan') }}</textarea>
                    </div>
                </div>
                <div class="mt-7 flex flex-col-reverse justify-between gap-3 border-t border-[#eef0f8] pt-5 sm:flex-row">
                    <a href="/pertemuan" class="grid min-h-11 place-items-center rounded-xl bg-[#eef1ff] px-6 text-sm font-semibold text-[#536084] hover:bg-[#e4e8fa]">← Batal</a>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <button type="submit" name="aksi" value="simpan" class="min-h-11 rounded-xl border border-[#1554d6] bg-white px-6 text-sm font-bold text-[#1554d6] hover:bg-[#f2f6ff]">Simpan Terjadwal</button>
                        <button type="submit" name="aksi" value="buka" class="min-h-11 rounded-xl bg-[#1554d6] px-6 text-sm font-bold text-white shadow-lg shadow-[#1554d6]/20 hover:bg-[#1045b4]">◉ Simpan dan Buka Sesi</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
<script>
    function setTemplate(prefix) {
        const input = document.getElementById('judul');
        if (!input) return;
        let val = input.value;
        const colonIdx = val.indexOf(':');
        let topic = '';
        if (colonIdx !== -1) {
            topic = val.substring(colonIdx + 1).trim();
        } else {
            topic = val.replace(/^Pertemuan\s*[\d\-]*\s*:?\s*/i, '').trim();
        }
        input.value = prefix + (topic ? topic : '');
        input.focus();
        input.setSelectionRange(input.value.length, input.value.length);
    }

    const mulai = document.querySelector('#jam_mulai');
    const selesai = document.querySelector('#jam_selesai');
    const cek = () => {
        selesai.setCustomValidity(mulai.value && selesai.value && selesai.value <= mulai.value ? 'Jam selesai harus setelah jam mulai.' : '');
    };
    mulai.addEventListener('change', cek);
    selesai.addEventListener('change', cek);
</script>
</body>
</html>
