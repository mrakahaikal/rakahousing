<aside x-cloak
       x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-90'"
       id="sidebar"
       class="min-w-[270px] overflow-y-auto left-0 fixed flex h-svh shrink-0 z-30 bg-primary text-white [&::-webkit-scrollbar]:hidden transition-transform duration-300 md:translate-x-0 md:relative">
    <div class="flex h-full w-full flex-col gap-[40px] pt-[40px]">
        <div class="pl-[30px]">
            <a href="/" class="shrink-0">
                <x-application-logo class="max-h-10 bg-white"></x-application-logo>
                RakaHousing
                {{--                    <img src="assets/images/logos/logo-white.svg" alt="icon" />--}}
            </a>
        </div>
        <nav class="flex flex-col gap-[40px] pb-[40px] pl-[30px]">
            <section id="General" class="flex flex-col gap-[24px]">
                <h3 class="text-sm font-semibold leading-[21px]">GENERAL</h3>
                <ul class="flex flex-col gap-[24px]">
                    <li class="group">
                        <a href="">
                            <div class="relative flex items-center gap-[6px]">
                                <img src="assets/images/icons/overview-n.svg" alt="icon"
                                     class="shrink-0 group-[&.active]:hidden" />
                                <p class="group-[&.active]:font-semibold group-[&.active]:text-success">
                                    Overview</p>
                            </div>
                        </a>
                    </li>
                    <li class="active group">
                        <a href="my-mortgages.html">
                            <div class="relative flex items-center gap-[6px]">
                                <img src="assets/images/icons/mortgages-y.svg" alt="icon"
                                     class="hidden shrink-0 group-[&.active]:block" />
                                <p class="group-[&.active]:font-semibold group-[&.active]:text-success">
                                    Mortgages</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="">
                            <div class="relative flex items-center gap-[6px]">
                                <img src="assets/images/icons/bank-interests-n.svg" alt="icon"
                                     class="shrink-0 group-[&.active]:hidden" />
                                <p class="group-[&.active]:font-semibold group-[&.active]:text-success">Bank
                                    Interests</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="">
                            <div class="relative flex items-center gap-[6px]">
                                <img src="assets/images/icons/big-rewards-n.svg" alt="icon"
                                     class="shrink-0 group-[&.active]:hidden" />
                                <p class="group-[&.active]:font-semibold group-[&.active]:text-success">Big
                                    Rewards</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </section>
            <section id="Others" class="flex flex-col gap-[24px]">
                <h3 class="text-sm font-semibold leading-[21px]">OTHERS</h3>
                <ul class="flex flex-col gap-[24px]">
                    <li class="group">
                        <a href="">
                            <div class="relative flex items-center gap-[6px]">
                                <img src="assets/images/icons/help-center-n.svg" alt="icon"
                                     class="shrink-0 group-[&.active]:hidden" />
                                <p class="group-[&.active]:font-semibold group-[&.active]:text-success">Help
                                    Center</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="">
                            <div class="relative flex items-center gap-[6px]">
                                <img src="assets/images/icons/supports-n.svg" alt="icon"
                                     class="shrink-0 group-[&.active]:hidden" />
                                <p class="group-[&.active]:font-semibold group-[&.active]:text-success">
                                    Supports</p>
                            </div>
                        </a>
                    </li>
                    <li class="group">
                        <a href="">
                            <div class="relative flex items-center gap-[6px]">
                                <img src="assets/images/icons/settings-n.svg" alt="icon"
                                     class="shrink-0 group-[&.active]:hidden" />
                                <p class="group-[&.active]:font-semibold group-[&.active]:text-success">
                                    Settings</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </section>
        </nav>
    </div>
</aside>
