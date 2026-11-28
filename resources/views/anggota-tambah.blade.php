<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Anggota | ITSEN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f8f8fd] font-sans text-[#172044]">
    <div class="min-h-screen lg:grid lg:grid-cols-[250px_1fr]">
        <aside class="sticky top-0 h-screen hidden border-r border-[#e7e9f4] bg-white lg:flex lg:flex-col">
            <div class="flex h-[72px] items-center gap-3 border-b border-[#e7e9f4] px-7">
                <img src="{{ asset('images/logo-it.jpeg') }}" alt="Logo ITSEN" width="36" height="36" class="h-9 w-9 rounded-xl object-cover">
                <div><p class="font-bold">ITSEN</p><p class="text-[11px] text-[#7a82a8]">Admin Portal</p></div>
            </div>
            @include('components.admin.sidebar', ['active' => 'anggota'])
            <x-admin.footer />
        </aside>
        <main>
<x-admin.header title="Tambah Anggota" />
            <div class="mx-auto max-w-[1440px] px-5 py-8 sm:px-8 sm:py-10">
                <div class="mb-6">
                    <p class="text-xs font-semibold text-[#5b43db]"><a href="/anggota" class="hover:underline">Anggota</a> <span class="mx-2 text-[#a4a9c0]">›</span> Tambah Anggota</p>
                    <h2 class="mt-2 text-2xl font-bold">Tambah Anggota Baru</h2>
                    <p class="mt-1 text-sm text-[#667099]">Tambahkan data siswa ekskul IT Club dan buat akun akses presensi.</p>
                </div>
                @if ($errors->any())
                    <div class="mb-5 rounded-xl border border-[#ffc8cf] bg-[#fff4f5] p-4 text-sm text-[#b42f47]">
                        <p class="font-bold">Data belum dapat disimpan.</p>
                        <ul class="mt-2 list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                <form action="/anggota" method="post" class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#e7e9f4]">
                    @csrf
                    <section class="p-5 sm:p-7">
                        <div class="mb-6 flex items-start gap-3 border-b border-[#eef0f8] pb-5"><span class="grid h-8 w-8 place-items-center rounded-xl bg-[#e0e8ff] text-xs font-bold text-[#4262d8]">01</span><div><h3 class="text-sm font-bold">Data Anggota</h3><p class="text-xs text-[#7a82a8]">Informasi identitas siswa</p></div></div>
                        <div class="space-y-5">
                            <div><label for="nama_lengkap" class="mb-2 block text-xs font-bold">Nama Lengkap <span class="text-[#e24c65]">*</span></label><input id="nama_lengkap" name="nama_lengkap" type="text" value="{{ old('nama_lengkap') }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#6344e5]" placeholder="Masukkan nama lengkap"></div>
                            <div><label for="nit" class="mb-2 block text-xs font-bold">NIT <span class="text-[#e24c65]">*</span></label><input id="nit" name="nit" type="text" value="{{ old('nit') }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#6344e5]" placeholder="Contoh: 20260001"><p class="mt-2 text-xs text-[#7a82a8]">NIT digunakan otomatis sebagai username login.</p></div>
                            <div><label for="kelas_jurusan" class="mb-2 block text-xs font-bold">Kelas &amp; Jurusan <span class="text-[#e24c65]">*</span></label><input id="kelas_jurusan" name="kelas_jurusan" type="text" value="{{ old('kelas_jurusan') }}" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#6344e5]" placeholder="Contoh: XI PPLG 1"></div>
                            <div><label for="no_hp" class="mb-2 block text-xs font-bold">Nomor WhatsApp / HP <span class="font-normal text-[#7a82a8]">(Opsional)</span></label><input id="no_hp" name="no_hp" type="tel" value="{{ old('no_hp') }}" class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm" placeholder="Contoh: 081234567890"></div>
                        </div>
                    </section>
                    <section class="border-t border-[#eef0f8] bg-[#fcfcff] p-5 sm:p-7">
                        <div class="mb-6 flex items-start gap-3 border-b border-[#eef0f8] pb-5"><span class="grid h-8 w-8 place-items-center rounded-xl bg-[#f0e8ff] text-xs font-bold text-[#7137d7]">02</span><div><h3 class="text-sm font-bold">Pengaturan Akun Mobile</h3><p class="text-xs text-[#7a82a8]">Akun ini digunakan untuk masuk ke ITSEN.</p></div></div>
                        <div class="space-y-5"><div><label for="username" class="mb-2 block text-xs font-bold">Username</label><input id="username" type="text" readonly class="min-h-11 w-full rounded-xl border border-[#d9def8] bg-[#e7ebff] px-4 text-sm text-[#5462b9]" placeholder="Terisi otomatis dari NIT"></div><div><label for="password" class="mb-2 block text-xs font-bold">Kata Sandi Awal <span class="text-[#e24c65]">*</span></label><input id="password" name="password" type="password" required minlength="8" class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm" placeholder="Minimal 8 karakter"><p class="mt-2 text-xs text-[#168349]">Minimal 8 karakter. Siswa wajib mengganti sandi saat login pertama.</p></div><label class="flex items-start gap-3 rounded-xl border border-[#e7e9f4] bg-white p-4 text-xs text-[#536084]"><input name="must_change_password" type="checkbox" checked class="mt-0.5 h-4 w-4 accent-[#5638e4]"><span><b class="block text-[#26345d]">Wajib ganti kata sandi saat login pertama</b><span class="mt-1 block">Akun anggota akan diarahkan ke halaman ganti sandi.</span></span></label></div>
                    </section>
                    <div class="flex flex-col-reverse justify-between gap-3 border-t border-[#eef0f8] p-5 sm:flex-row sm:p-7"><a href="/anggota" class="grid min-h-11 place-items-center rounded-xl border border-[#e1e4ef] px-6 text-sm font-semibold text-[#536084] hover:bg-[#f7f8fc]">Batal</a><button type="submit" class="min-h-11 rounded-xl bg-[#5638e4] px-7 text-sm font-bold text-white shadow-lg shadow-[#5638e4]/20 hover:bg-[#4428c5]">Simpan Anggota</button></div>
                </form>
            </div>
        </main>
    </div>
    <script>const nit=document.querySelector('#nit');const username=document.querySelector('#username');nit.addEventListener('input',()=>username.value=nit.value);</script>
</body>
</html>
