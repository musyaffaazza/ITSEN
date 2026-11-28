@props(['placeholder' => 'Cari data...'])

<label class="hidden min-h-11 w-72 items-center gap-2 rounded-xl bg-[#f4f5fb] px-4 text-xs text-[#7a82a8] sm:flex">
    <span aria-hidden="true">⌕</span>
    <input type="search" class="w-full bg-transparent outline-none placeholder:text-[#9aa1bd]" placeholder="{{ $placeholder }}" aria-label="Cari data">
</label>
