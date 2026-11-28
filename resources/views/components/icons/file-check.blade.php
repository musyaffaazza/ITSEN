@props(['class' => 'h-5 w-5'])

<svg {{ $attributes->merge(['class' => $class, 'viewBox' => '0 0 24 24', 'fill' => 'none', 'stroke' => 'currentColor', 'stroke-width' => '1.8', 'stroke-linecap' => 'round', 'stroke-linejoin' => 'round', 'aria-hidden' => 'true']) }}>
    <rect x="5" y="4" width="14" height="17" rx="1.5" />
    <path d="M9 4.5V3h6v1.5M8.5 11l2 2 5-5M8.5 17h7" />
</svg>
