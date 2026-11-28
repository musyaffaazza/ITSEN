<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Anggota | ITSEN</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f8f8fd] font-sans text-[#172044]">
        <div class="min-h-screen lg:grid lg:grid-cols-[250px_1fr]">
            <aside class="sticky top-0 h-screen hidden border-r border-[#e7e9f4] bg-white lg:flex lg:flex-col">
                <div class="flex h-[72px] items-center gap-3 border-b border-[#e7e9f4] px-7">
                    <img src="{{ asset('images/logo-it.jpeg') }}" alt="Logo ITSEN" width="36" height="36" class="h-9 w-9 rounded-xl object-cover">
                    <div><p class="font-bold leading-tight">ITSEN</p><p class="text-[11px] text-[#7a82a8]">Admin Portal</p></div>
                </div>
                @include('components.admin.sidebar', ['active' => 'anggota'])
                <x-admin.footer />
            </aside>

            <main>
                <x-admin.header title="Anggota" />

                <div class="mx-auto max-w-[1440px] px-5 py-8 sm:px-8 sm:py-10">
                    @if (session('success'))
                        <div class="mb-5 flex items-center justify-between rounded-xl border border-[#b7f0d4] bg-[#f0fff8] px-4 py-3 text-sm font-semibold text-[#168349]">
                            <div class="flex items-center gap-2">
                                <span>✓</span>
                                <span>{{ session('success') }}</span>
                            </div>
                            <button type="button" onclick="this.parentElement.remove()" class="text-[#168349]/60 hover:text-[#168349]">✕</button>
                        </div>
                    @endif

                    <!-- Top Bar: Title & Action -->
                    <section class="mb-6 flex flex-col justify-between gap-4 xl:flex-row xl:items-center">
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">Anggota</h2>
                            <p class="mt-1 text-sm text-[#667099]">Kelola data anggota dan akses akun siswa IT Club SMK Negeri 1 Gunungputri.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" class="flex min-h-11 items-center gap-2 rounded-xl border border-[#e1e3ef] bg-white px-4 text-xs font-bold text-[#425077] hover:bg-[#f6f7fc]">
                                <span>↓</span>
                                <span>Ekspor Data</span>
                            </button>
                            <a href="/anggota/tambah" class="flex min-h-11 items-center gap-2 rounded-xl bg-[#5638e4] px-5 text-xs font-bold text-white shadow-lg shadow-[#5638e4]/20 hover:bg-[#4428c5]">
                                <span>+</span>
                                <span>Tambah Anggota</span>
                            </a>
                        </div>
                    </section>

                    <!-- Stat Cards -->
                    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]">
                            <p class="text-[10px] font-bold tracking-wide text-[#70789e]">TOTAL SISWA</p>
                            <div class="mt-2 flex items-center justify-between">
                                <strong class="text-3xl">{{ $totalAnggota }}</strong>
                                <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#eef0ff] text-[#5138e6]">♧</span>
                            </div>
                            <p class="mt-1 text-[10px] text-[#7a82a8]">Anggota Terdaftar</p>
                        </article>

                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]">
                            <p class="text-[10px] font-bold tracking-wide text-[#70789e]">STATUS AKTIF</p>
                            <div class="mt-2 flex items-center justify-between">
                                <strong class="text-3xl text-[#25ad69]">{{ $totalAktif }}</strong>
                                <span class="rounded-full bg-[#ddf9e9] px-2 py-1 text-[10px] font-bold text-[#168349]">
                                    {{ $totalAnggota > 0 ? round($totalAktif / $totalAnggota * 100) : 0 }}%
                                </span>
                            </div>
                            <p class="mt-1 text-[10px] text-[#7a82a8]">Akun dapat digunakan</p>
                        </article>

                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]">
                            <p class="text-[10px] font-bold tracking-wide text-[#70789e]">STATUS NONAKTIF</p>
                            <div class="mt-2 flex items-center justify-between">
                                <strong class="text-3xl">{{ $totalNonaktif }}</strong>
                                <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#eef0ff] text-[#64709b]">⌁</span>
                            </div>
                            <p class="mt-1 text-[10px] text-[#7a82a8]">Akun dinonaktifkan</p>
                        </article>

                        <article class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-[#eef0f8]">
                            <p class="text-[10px] font-bold tracking-wide text-[#70789e]">DISTRIBUSI KELAS</p>
                            <div class="mt-2 flex items-center justify-between">
                                <strong class="text-3xl text-[#6938e6]">{{ $totalKelas }}</strong>
                                <span class="text-[10px] font-bold text-[#6a73a2]">Kelas</span>
                            </div>
                            <p class="mt-1 text-[10px] text-[#7a82a8]">Kelompok kelas aktif</p>
                        </article>
                    </section>

                    <!-- Filter Card (Horizontal 1 Line) -->
                    <section class="mt-5 rounded-2xl bg-white p-4 shadow-sm ring-1 ring-[#eef0f8]">
                        <form method="GET" action="/anggota" class="flex flex-col gap-3 md:flex-row md:items-center">
                            <!-- Search -->
                            <label class="flex min-h-11 flex-1 items-center gap-2 rounded-xl border border-[#e5e7f1] bg-white px-3 text-xs text-[#7a82a8] focus-within:border-[#5638e4]">
                                <span>⌕</span>
                                <input type="search" name="q" value="{{ request('q') }}" class="w-full bg-transparent outline-none placeholder:text-[#9aa1bd]" placeholder="Cari nama atau NIT..." aria-label="Cari nama atau NIT">
                            </label>

                            <!-- Kelas -->
                            <select name="kelas" class="min-h-11 rounded-xl border border-[#e5e7f1] bg-white px-3 text-xs text-[#536084] outline-none focus:border-[#5638e4] md:w-48" aria-label="Filter kelas">
                                <option value="">Semua Kelas</option>
                                @foreach($kelasList ?? [] as $k)
                                    <option value="{{ $k }}" {{ request('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>

                            <!-- Status -->
                            <select name="status" class="min-h-11 rounded-xl border border-[#e5e7f1] bg-white px-3 text-xs text-[#536084] outline-none focus:border-[#5638e4] md:w-40" aria-label="Filter status">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>

                            <!-- Button Group -->
                            <div class="flex items-center gap-2">
                                <button type="submit" class="flex min-h-11 items-center justify-center rounded-xl bg-[#5638e4] px-6 text-xs font-bold text-white shadow-sm transition hover:bg-[#4428c5]">
                                    Cari
                                </button>
                                @if(request('q') || request('kelas') || request('status'))
                                    <a href="/anggota" class="flex min-h-11 items-center justify-center rounded-xl border border-[#e5e7f1] bg-white px-4 text-xs font-semibold text-[#536084] transition hover:bg-[#f5f6fb]" title="Reset Filter">
                                        ↻
                                    </a>
                                @endif
                            </div>
                        </form>
                    </section>

                    <!-- Table Section -->
                    <section class="mt-5 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-[#eef0f8]">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[760px] text-left text-xs">
                                <thead class="bg-[#f4f5fd] text-[10px] font-bold tracking-wider uppercase text-[#667099]">
                                    <tr>
                                        <th class="px-5 py-4">NAMA ANGGOTA</th>
                                        <th class="px-4 py-4">KELAS</th>
                                        <th class="px-4 py-4">NO. WHATSAPP / HP</th>
                                        <th class="px-4 py-4">STATUS</th>
                                        <th class="px-5 py-4 text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#eef0f8]">
                                @forelse ($anggota as $a)
                                    @php
                                        $inisial = collect(explode(' ', $a->nama_lengkap))->take(2)->map(fn($w) => strtoupper($w[0]))->join('');
                                        $colors = [
                                            ['bg-[#e7edff]', 'text-[#3159dc]'],
                                            ['bg-[#f0e5ff]', 'text-[#7137d7]'],
                                            ['bg-[#e5f9f0]', 'text-[#1a7a4e]'],
                                            ['bg-[#fff0e5]', 'text-[#c05a1a]']
                                        ];
                                        $c = $colors[$a->id % count($colors)];
                                    @endphp
                                    <tr class="transition hover:bg-[#fafbff]">
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-3">
                                                <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full {{ $c[0] }} text-xs font-bold {{ $c[1] }}">{{ $inisial }}</span>
                                                <div>
                                                    <b class="text-xs font-bold text-[#172044]">{{ $a->nama_lengkap }}</b>
                                                    <small class="block text-[11px] text-[#7a82a8]">NIT: {{ $a->nit }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-block rounded-md bg-[#e9ecff] px-2.5 py-1 text-[11px] font-semibold text-[#4057c5]">{{ $a->kelas_jurusan }}</span>
                                        </td>
                                        <td class="px-4 py-4 text-[#536084] font-medium">{{ $a->no_hp ?: '-' }}</td>
                                        <td class="px-4 py-4">
                                            @if($a->status === 'aktif')
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#ddf9e9] px-2.5 py-1 text-[10px] font-bold text-[#168349]">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#168349]"></span>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-[#eef0ff] px-2.5 py-1 text-[10px] font-bold text-[#69739d]">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-[#69739d]"></span>
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <!-- Edit -->
                                                <a href="/anggota/{{ $a->id }}/edit" class="grid h-8 w-8 place-items-center rounded-lg border border-[#e1e4ef] bg-white text-[#536084] transition hover:border-[#5638e4] hover:bg-[#f0edff] hover:text-[#5638e4]" title="Edit Anggota">
                                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                                </a>

                                                <!-- Status Toggle -->
                                                <form method="POST" action="/anggota/{{ $a->id }}/status" class="inline">
                                                    @csrf
                                                    <button type="submit" class="grid h-8 w-8 place-items-center rounded-lg border border-[#e1e4ef] bg-white {{ $a->status === 'aktif' ? 'text-[#c05a1a] hover:border-[#c05a1a] hover:bg-[#fff7ed]' : 'text-[#168349] hover:border-[#168349] hover:bg-[#f0fdf4]' }} transition" title="{{ $a->status === 'aktif' ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                                        @if($a->status === 'aktif')
                                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                                        @else
                                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                                        @endif
                                                    </button>
                                                </form>

                                                <!-- Reset Password -->
                                                <button type="button" onclick="openReset({{ $a->id }}, '{{ addslashes($a->nama_lengkap) }}')" class="grid h-8 w-8 place-items-center rounded-lg border border-[#e1e4ef] bg-white text-[#536084] transition hover:border-[#3159dc] hover:bg-[#f0f4ff] hover:text-[#3159dc]" title="Reset Password">
                                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                                </button>

                                                <!-- Hapus -->
                                                <form method="POST" action="/anggota/{{ $a->id }}/hapus" class="inline" onsubmit="return confirm('Hapus anggota {{ addslashes($a->nama_lengkap) }}? Akun login juga akan dihapus permanen.')">
                                                    @csrf
                                                    <button type="submit" class="grid h-8 w-8 place-items-center rounded-lg border border-[#ffd5d9] bg-white text-[#d94354] transition hover:bg-[#fff0f2]" title="Hapus Anggota">
                                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-12 text-center text-[#7a82a8]">
                                            <div class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-[#f4f5fd] text-lg text-[#7a82a8]">⌕</div>
                                            <p class="mt-2 text-sm font-semibold text-[#536084]">Tidak ada data anggota ditemukan</p>
                                            <p class="mt-1 text-xs text-[#a0a7c4]">Coba ubah kata kunci pencarian atau reset filter.</p>
                                            @if(request('q') || request('kelas') || request('status'))
                                                <a href="/anggota" class="mt-3 inline-block rounded-xl border border-[#e1e4ef] bg-white px-4 py-2 text-xs font-semibold text-[#5638e4] hover:bg-[#f8f9ff]">Reset Filter</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Footer -->
                        <div class="flex flex-col justify-between gap-3 border-t border-[#eef0f8] px-5 py-4 text-xs text-[#7a82a8] sm:flex-row sm:items-center">
                            <span>Menampilkan {{ $anggota->firstItem() ?? 0 }} - {{ $anggota->lastItem() ?? 0 }} dari {{ $anggota->total() }} data siswa</span>
                            <div>{{ $anggota->links() }}</div>
                        </div>
                    </section>
                </div>
            </main>
        </div>

        <!-- Modal Reset Password -->
        <div id="modalReset" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
            <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-bold text-base text-[#172044]" id="modalTitle">Reset Password</h3>
                        <p class="mt-1 text-xs text-[#7a82a8]">Masukkan kata sandi baru untuk anggota ini.</p>
                    </div>
                    <button type="button" onclick="closeReset()" class="text-[#7a82a8] hover:text-[#172044]">✕</button>
                </div>
                <form id="formReset" method="POST" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="mb-2 block text-xs font-bold text-[#536084]">Kata Sandi Baru <span class="text-[#e24c65]">*</span></label>
                        <input name="password" type="password" minlength="8" required class="min-h-11 w-full rounded-xl border border-[#e1e4ef] px-4 text-sm outline-none focus:border-[#5638e4]" placeholder="Minimal 8 karakter">
                        <p class="mt-1.5 text-[10px] text-[#7a82a8]">Anggota akan diminta mengganti sandi saat login.</p>
                    </div>
                    <div class="flex gap-2 pt-2">
                        <button type="button" onclick="closeReset()" class="flex-1 rounded-xl border border-[#e1e4ef] py-2.5 text-xs font-semibold text-[#536084] hover:bg-[#f7f8fc]">Batal</button>
                        <button type="submit" class="flex-1 rounded-xl bg-[#5638e4] py-2.5 text-xs font-bold text-white shadow-lg shadow-[#5638e4]/20 hover:bg-[#4428c5]">Simpan Password</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
        function openReset(id, nama) {
            document.getElementById('modalTitle').textContent = 'Reset Password — ' + nama;
            document.getElementById('formReset').action = '/anggota/' + id + '/reset-password';
            document.getElementById('formReset').querySelector('input[name=password]').value = '';
            const modal = document.getElementById('modalReset');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeReset() {
            const modal = document.getElementById('modalReset');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        </script>
    </body>
</html>
