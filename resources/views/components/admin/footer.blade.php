<div class="mt-auto p-4 space-y-3">
    <div class="flex items-center gap-3 rounded-2xl bg-[#eff3ff] p-3">
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#1554d6] text-xs font-bold text-white">
            AD
        </div>
        <div>
            <p class="text-xs font-bold text-slate-900 leading-tight">Admin Ekskul</p>
            <p class="text-[11px] text-slate-500 leading-tight">Pembina IT Club</p>
        </div>
    </div>
    <form method="POST" action="/logout" class="px-1">
        @csrf
        <button type="submit" class="inline-flex items-center gap-2 text-xs font-bold text-[#e14a63] hover:text-[#b91c1c] transition">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            <span>Keluar</span>
        </button>
    </form>
</div>
