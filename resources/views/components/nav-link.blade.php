@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link active text-white bg-[#6EC193]'
            : 'nav-link text-light hover:bg-[#23877A]';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
