@props(['label' => 'Al Zain', 'seed' => null, 'class' => 'aspect-[4/5]'])
@php
    $seed = $seed ?? $label;
    $palettes = [
        ['#f6e7e4', '#e2ada4'],
        ['#f9f4ec', '#c9a24b'],
        ['#eecfc9', '#7c3a4d'],
        ['#f6e7e4', '#b5635a'],
        ['#f9f4ec', '#5f2c3c'],
    ];
    $p = $palettes[abs(crc32((string) $seed)) % count($palettes)];
    $initial = mb_strtoupper(mb_substr(trim($label), 0, 1));
@endphp
<div {{ $attributes->merge(['class' => $class . ' w-full flex items-center justify-center']) }}
     style="background: linear-gradient(135deg, {{ $p[0] }}, {{ $p[1] }});">
    <span class="font-serif text-4xl md:text-5xl" style="color: {{ $p[1] }}; mix-blend-mode: multiply; opacity:.55;">{{ $initial }}</span>
</div>
