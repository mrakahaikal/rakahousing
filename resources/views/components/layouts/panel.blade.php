@include('components.layouts.partials.head')
<div
    x-data="{ sidebarIsOpen: false }"
    class="relative flex w-full flex-col md:flex-row"
>
    <!-- This allows screen readers to skip the sidebar and go directly to the main content. -->
    <a class="sr-only" href="#main-content">skip to the main content</a>

    <!-- dark overlay for when the sidebar is open on smaller screens  -->
    <div
        x-cloak
        x-show="sidebarIsOpen"
        class="fixed inset-0 z-20 bg-primary/10 backdrop-blur-xs md:hidden"
        aria-hidden="true"
        x-on:click="sidebarIsOpen = false"
        x-transition.opacity
    ></div>

    <!-- Sidebar -->
    <x-layouts.panel.sidebar/>

    <!-- top navbar & main content  -->
    <div class="h-svh w-full overflow-y-auto pt-7.5 px-7.5 bg-surface-alt">
        <!-- top navbar  -->
        <x-layouts.panel.topbar />
        <!-- main content  -->
        <main class="flex w-full flex-col justify-center gap-[30px] py-[28px]">
            <!-- content header -->
            <header class="flex items-center justify-between">
                <div class="flex flex-col gap-[6px]">
                    <h1 class="text-[26px] font-bold leading-[39px]">My Mortgages</h1>
                    <p class="text-sm leading-[21px] text-secondary">We will help you achieve greatest</p>
                </div>
                <div class="buttons flex gap-[12px]">
                    <button type="button" class="font-semibold text-white rounded-full py-[14px] px-5 bg-primary transition-all duration-300">
                        Export to
                    </button>
                    <a href="">
                        <div class="font-semibold rounded-full py-[14px] px-5 bg-success text-primary ">
                            Add New
                        </div>
                    </a>
                </div>
            </header>
            <!-- Add main content here  -->
            <section id="Cards" class="flex flex-col gap-[30px]">
                <div
                    class="card flex items-center gap-[12px] pt-[10px] pb-5 bg-white border border-[#F2F2F4] px-[10px] rounded-[30px]">
                    <div class="w-[150px] h-[168px] shrink-0 rounded-[30px] overflow-hidden flex justify-center items-center">
                        <img src="assets/images/thumbnails/thumbnails-6.png" alt="image" class="w-full h-full object-cover">
                    </div>
                    <div class="px-[10px] flex flex-col gap-[18px] w-full">
                        <div class="title flex flex-col gap-[6px]">
                            <h2 class="font-bold text-lg leading-[27px]">Anggana Parahyangan Golf</h2>
                            <div class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/location.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">Melon, Bandung</p>
                            </div>
                        </div>
                        <div class="points grid grid-cols-3 gap-x-[18px] gap-y-[12px]">
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/slider-vertical.svg" alt="icon"
                                     class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">8 Bedroom</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/building.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">224 M²</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/note-favorite.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">SHGB</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/slider-horizontal.svg" alt="icon"
                                     class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">2 Bathroom</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/maximize.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">320 M²</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/flash.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">2980 Watts</p>
                            </div>
                        </div>
                    </div>
                    <div class="buttons flex flex-col gap-[12px] shrink-0">
                        <a href="">
                            <div
                                class="font-semibold hover:text-[#FAFAFA] rounded-full py-[12px] w-[140px] border text-center border-primary text-primary bg-primary transition-all duration-300 text-white">
                                Manage</div>
                        </a>
                        <a href="my-mortgages-details-waiting.html">
                            <div
                                class="font-semibold hover:text-[#FAFAFA] rounded-full py-[12px] w-[140px] bg-white border text-center border-primary text-primary hover:bg-primary transition-all duration-300">
                                Details</div>
                        </a>
                        <a href="">
                            <div
                                class="font-semibold hover:text-[#FAFAFA] rounded-full py-[12px] w-[140px] bg-white border text-center border-primary text-primary hover:bg-primary transition-all duration-300">
                                Download</div>
                        </a>
                    </div>
                </div>
                <div
                    class="card flex items-center gap-[12px] pt-[10px] pb-5 bg-white border border-[#F2F2F4] px-[10px] rounded-[30px]">
                    <div
                        class="w-[150px] h-[168px] shrink-0 rounded-[30px] overflow-hidden flex justify-center items-center">
                        <img src="assets/images/thumbnails/thumbnails-7.png" alt="image"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="px-[10px] flex flex-col gap-[18px] w-full">
                        <div class="title flex flex-col gap-[6px]">
                            <h2 class="font-bold text-lg leading-[27px]">Anggana Parahyangan Golf</h2>
                            <div class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/location.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">Melon, Bandung</p>
                            </div>
                        </div>
                        <div class="points grid grid-cols-3 gap-x-[18px] gap-y-[12px]">
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/slider-vertical.svg" alt="icon"
                                     class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">8 Bedroom</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/building.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">224 M²</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/note-favorite.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">SHGB</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/slider-horizontal.svg" alt="icon"
                                     class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">2 Bathroom</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/maximize.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">320 M²</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/flash.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">2980 Watts</p>
                            </div>
                        </div>
                    </div>
                    <div class="buttons flex flex-col gap-[12px] shrink-0">
                        <a href="">
                            <div
                                class="font-semibold hover:text-[#FAFAFA] rounded-full py-[12px] w-[140px] border text-center border-primary text-primary bg-primary transition-all duration-300 text-white">
                                Manage</div>
                        </a>
                        <a href="my-mortgages-details-aproved.html">
                            <div
                                class="font-semibold hover:text-white rounded-full py-[12px] w-[140px] bg-white border text-center border-primary text-primary hover:bg-primary transition-all duration-300">
                                Details</div>
                        </a>
                        <a href="">
                            <div
                                class="font-semibold hover:text-white rounded-full py-[12px] w-[140px] bg-white border text-center border-primary text-primary hover:bg-primary transition-all duration-300">
                                Download</div>
                        </a>
                    </div>
                </div>
                <div
                    class="card flex items-center gap-[12px] pt-[10px] pb-5 bg-white border border-[#F2F2F4] px-[10px] rounded-[30px]">
                    <div
                        class="w-[150px] h-[168px] shrink-0 rounded-[30px] overflow-hidden flex justify-center items-center">
                        <img src="assets/images/thumbnails/thumbnails-5.png" alt="image"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="px-[10px] flex flex-col gap-[18px] w-full">
                        <div class="title flex flex-col gap-[6px]">
                            <h2 class="font-bold text-lg leading-[27px]">Anggana Parahyangan Golf</h2>
                            <div class="flex items-center gap-[6px]">
                                <img src="assets/images/icons/location.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">Melon, Bandung</p>
                            </div>
                        </div>
                        <div class="points grid grid-cols-3 gap-x-[18px] gap-y-[12px]">
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/slider-vertical.svg" alt="icon"
                                     class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">8 Bedroom</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/building.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">224 M²</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/note-favorite.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">SHGB</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/slider-horizontal.svg" alt="icon"
                                     class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">2 Bathroom</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/maximize.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">320 M²</p>
                            </div>
                            <div
                                class="flex items-center gap-[6px] p-[10px] border border-[#F2F2F4] rounded-[14px]">
                                <img src="assets/images/icons/flash.svg" alt="icon" class="shrink-0 size-5">
                                <p class="font-semibold text-sm leading-[21px]">2980 Watts</p>
                            </div>
                        </div>
                    </div>
                    <div class="buttons flex flex-col gap-[12px] shrink-0">
                        <a href="">
                            <div
                                class="font-semibold hover:text-[#FAFAFA] rounded-full py-[12px] w-[140px] border text-center border-primary text-primary bg-primary transition-all duration-300 text-white">
                                Manage</div>
                        </a>
                        <a href="my-mortgages-details-aproved.html">
                            <div
                                class="font-semibold hover:text-white rounded-full py-[12px] w-[140px] bg-white border text-center border-primary text-primary hover:bg-primary transition-all duration-300">
                                Details</div>
                        </a>
                        <a href="">
                            <div
                                class="font-semibold hover:text-white rounded-full py-[12px] w-[140px] bg-white border text-center border-primary text-primary hover:bg-primary transition-all duration-300">
                                Download</div>
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
@include('components.layouts.partials.foot')
