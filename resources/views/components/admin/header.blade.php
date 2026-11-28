@props([
    'title' => null,
    'avatar' => true,
])

<header class="flex min-h-[64px] items-center justify-between border-b border-[#e7e9f4] bg-white px-5 sm:px-8">
    <div class="flex items-center gap-4">
        <button type="button" class="grid h-9 w-9 place-items-center rounded-xl border border-[#e5e7f1] lg:hidden" aria-label="Buka navigasi">☰</button>
        <div class="flex items-center gap-2 text-xs font-medium text-[#7a82a8]">
            <span>Sistem Presensi IT Club</span>
            <span class="text-slate-400">›</span>
            <span class="font-bold text-[#1554d6]">Portal Administrasi</span>
        </div>
    </div>
    <div class="flex items-center gap-3.5">
        <div class="relative w-48 sm:w-64">
            <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400">
                <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
            <input type="text" placeholder="Cari data..." class="w-full rounded-xl border border-slate-200 bg-[#f8f9fc] py-1.5 pl-8 pr-3 text-xs text-slate-800 placeholder-slate-400 outline-none focus:border-[#1554d6] focus:bg-white transition">
        </div>
        
        <!-- Bell Notification -->
        <button type="button" class="relative p-1 text-slate-500 hover:text-slate-700 transition" aria-label="Notifikasi">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            <span class="absolute top-0.5 right-0.5 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>

        <!-- User Profile Pill -->
        <div class="flex items-center gap-2 rounded-full bg-slate-100 py-1 pl-1 pr-3 text-xs font-bold text-slate-800">
            <div class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-200 text-slate-600">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <span>Admin</span>
        </div>
    </div>
</header>

