@include('components.layouts.partials.head')
<x-slot:headSlot>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</x-slot:headSlot>

<x-header />

{{ $slot }}

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@include('components.layouts.partials.foot')
