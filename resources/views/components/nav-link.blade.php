@props(['active'])

@php
$classes = ($active ?? false)
            ? 'hover:font-bold font-bold transition-all duration-300'
            : 'hover:font-bold transition-all duration-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
