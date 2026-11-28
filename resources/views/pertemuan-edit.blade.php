<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pertemuan | ITSEN</title>
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
            <x-admin.header title="Edit Pertemuan" />
            <div class="mx-auto max-w-[1440px] px-5 py-8 sm:px-8 sm:py-10">
                <div class="mb-6">
                    <p class="text-xs font-semibold text-[#5b43db]"><a href="/pertemuan" class="hover:underline">Pertemuan</a> <span class="mx-2 text-[#a4a9c0]">›</span> Edit Pertemuan</p>
                    <h2 class="mt-2 text-2xl font-bold">Edit Pertemuan</h2>
                    <p class="mt-1 text-sm text-[#667099]">Perbarui detail jadwal pertemuan.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-[#ffc8cf] bg-[#fff4f5] p-4 text-sm text-[#b42f47]">
                        <p class="font-bold">Data belum dapat disimpan.</p>
                        <ul class="mt-2 list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif

                <form action="/pertemuan/{{ $pertemuan->id }}" method="post" class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#e7e9f4]">
                    @csrf
                    <section class="p-5 sm:p-7">
                        <div class="space-y-5">
                            <div>
                                <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                                    <label for="judul" class="text-xs font-bold text-[#172044]">
                                        Judul Pertemuan <span class="text-[#e24c65]">*</span>
                                    </label>
                                    <div class="flex items-center gap-1.5 text-[11px]">
                                        <span class="text-[#7a82a8]">Gunakan Template:</span>
                                        <button type="button" onclick="setTemplate('Pertemuan {{ $pNum ?? 1 }}: ')" class="inline-flex items-center gap-1 rounded-lg border border-[#d6e3fc] bg-[#f0f4ff] px-2.5 py-1 font-bold text-[#1e58d8] hover:bg-[#e0ecff] transition shadow-2xs" title="Gunakan template Pertemuan {{ $pNum ?? 1 }}:">
                                            <span>Pertemuan {{ $pNum ?? 1 }}:</span>
                                        </button>
                                        <button type="button" onclick="setTemplate('Pertemuan -: ')" class="inline-flex items-center gap-1 rounded-lg border border-[#e1e4ef] bg-[#f8f9ff] px-2.5 py-1 font-bold text-[#536084] hover:bg-[#edf0fa] transition shadow-2xs" title="Gunakan template Pertemuan -:">
                                            <span>Pertemuan -:</span>
                                        </button>
                                    </div>
                                </div>
                                <input id="judul" name="judul" type="text" value="{{ old('judul', $pertemuan->judul) }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] bg-[#f8f9ff] px-4 text-sm font-medium text-[#172044] outline-none focus:border-[#1554d6] focus:bg-white transition" placeholder="Contoh: Pertemuan {{ $pNum ?? 1 }}: Dasar JavaScript">
                                <p class="mt-2 text-[10px] text-[#7a82a8]">Format template: <b>Pertemuan {{ $pNum ?? 1 }}: [Materi]</b> atau <b>Pertemuan -: [Materi]</b>.</p>
                            </div>
                            <div class="grid gap-5 sm:grid-cols-3">
                                <div><label for="tanggal" class="mb-2 block text-xs font-bold">Tanggal <span class="text-[#e24c65]">*</span></label><input id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', $pertemuan->tanggal->format('Y-m-d')) }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#6344e5]"></div>
                                <div><label for="jam_mulai" class="mb-2 block text-xs font-bold">Jam Mulai <span class="text-[#e24c65]">*</span></label><input id="jam_mulai" name="jam_mulai" type="time" value="{{ old('jam_mulai', $pertemuan->jam_mulai) }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#6344e5]"></div>
                                <div><label for="jam_selesai" class="mb-2 block text-xs font-bold">Jam Selesai <span class="text-[#e24c65]">*</span></label><input id="jam_selesai" name="jam_selesai" type="time" value="{{ old('jam_selesai', $pertemuan->jam_selesai) }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#6344e5]"></div>
                            </div>
                            <div class="max-w-xs"><label for="toleransi_menit" class="mb-2 block text-xs font-bold">Toleransi Keterlambatan (menit) <span class="text-[#e24c65]">*</span></label><input id="toleransi_menit" name="toleransi_menit" type="number" min="0" max="120" value="{{ old('toleransi_menit', $pertemuan->toleransi_menit) }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#6344e5]"></div>
                            <div><label for="catatan" class="mb-2 block text-xs font-bold">Catatan <span class="font-normal text-[#7a82a8]">(Opsional)</span></label><textarea id="catatan" name="catatan" rows="3" class="w-full rounded-xl border border-[#e1e4ef] px-4 py-3 text-sm outline-none focus:border-[#6344e5]" placeholder="Topik, materi, atau info tambahan...">{{ old('catatan', $pertemuan->catatan) }}</textarea></div>
                        </div>
                    </section>
                    <div class="flex flex-col-reverse justify-between gap-3 border-t border-[#eef0f8] p-5 sm:flex-row sm:p-7">
                        <a href="/pertemuan" class="grid min-h-11 place-items-center rounded-xl border border-[#e1e4ef] px-6 text-sm font-semibold text-[#536084] hover:bg-[#f7f8fc]">Batal</a>
                        <button type="submit" class="min-h-11 rounded-xl bg-[#1554d6] px-7 text-sm font-bold text-white shadow-lg shadow-[#1554d6]/20 hover:bg-[#1045b4]">Simpan Perubahan</button>
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
</script>
</body>
</html>
