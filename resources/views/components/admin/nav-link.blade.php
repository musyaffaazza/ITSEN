@props([
    'href',
    'label',
    'icon' => null,
    'active' => false,
    'badge' => null,
])

<a href="{{ $href }}" @class([
    'mt-1 flex min-h-11 items-center gap-3 rounded-xl px-4 text-sm font-medium transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#5638e4]',
    'bg-[#f0edff] font-semibold text-[#553be4]' => $active,
    'text-[#414d78] hover:bg-[#f5f5fc]' => ! $active,
]) @if ($active) aria-current="page" @endif>
    @if ($icon)
        <x-dynamic-component :component="'icons.' . $icon" class="h-5 w-5 shrink-0" />
    @endif
    <span>{{ $label }}</span>
    @if ($badge)
        <span class="ml-auto rounded-full bg-[#5638e4] px-2 py-0.5 text-[10px] text-white">{{ $badge }}</span>
    @endif
</a>
