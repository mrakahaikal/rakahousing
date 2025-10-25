<section class="relative flex flex-col w-full h-[712px]">
    <div class="absolute w-full h-[650px] overflow-hidden">
        <img src="{{ asset('assets/images/hero-image.webp') }}" class="w-full h-full object-cover" alt="hero image">
        <div class="absolute w-full h-full bg-primary/10"></div>
    </div>
    <div class="relative flex flex-col mt-[244px] gap-5 items-center">
        <p class="flex items-center gap-[6px] rounded-full py-[6px] px-3 bg-white bg-white border border-outline">
            <img src="assets/images/icons/crown.svg" class="flex shrink-0 size-5" alt="icon">
            <span class="font-semibold text-sm">Top Well-Designed House by Anggga Ark</span>
        </p>
        <h1 class="font-extrabold text-[46px] leading-[60px] text-center text-white">You Deserve Big House</h1>
        <p class="text-lg leading-8 text-center text-white">Dibangun oleh para professional sehingga memberikan<br>kecantikan sejati dan juga kehangatan bersama keluarga.</p>
    </div>
    @livewire('front.home.partials.search-form')
</section>
