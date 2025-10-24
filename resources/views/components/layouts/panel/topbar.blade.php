<section id="NavTop" class="flex w-full items-center justify-between bg-white p-4 rounded-3xl">
    <button
        type="button"
        class="md:hidden size-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]"
        x-on:click="sidebarIsOpen = true"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            class="size-5"
            aria-hidden="true"
        >
            <path
                d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2z"
            />
        </svg>
        <span class="sr-only">sidebar toggle</span>
    </button>
    <form class="relative">
        <button type="submit" class="absolute right-5 top-1/2 shrink-0 translate-y-[-50%]">
            <img src="assets/images/icons/search.svg" alt="icon" />
        </button>
        <input type="text"
               class="w-[440px] placeholder:font-normal placeholder:text-base placeholder:leading-[24px] placeholder:text-secondary rounded-full border border-primary py-[14px] pl-5  focus:outline-none pr-[64px] outline-none focus:ring-[2px] focus:ring-info focus:border-transparent transition-all duration-300"
               placeholder="Search your mortgage" />
    </form>
    <div class="flex items-center gap-5">
        <div class="flex items-center gap-[12px]">
            <a href="" class="shrink-0">
                <div
                    class="p-[13px] rounded-full border border-[#F2F2F4] hover:ring-[2px] hover:ring-info transition-all duration-300">
                    <img src="assets/images/icons/device-message.svg" alt="icon" />
                </div>
            </a>
            <a href="" class="shrink-0">
                <div
                    class="p-[13px] rounded-full border border-[#F2F2F4] hover:ring-[2px] hover:ring-info transition-all duration-300">
                    <img src="assets/images/icons/cup.svg" alt="icon" />
                </div>
            </a>
            <a href="" class="shrink-0">
                <div
                    class="p-[13px] rounded-full border border-[#F2F2F4] hover:ring-[2px] hover:ring-info transition-all duration-300">
                    <img src="assets/images/icons/folder-favorite.svg" alt="icon" />
                </div>
            </a>

        </div>
        <div class="w-px bg-[#F2F2F4] h-[50px]"></div>
        <button id="Profile" class="relative">
            <div class="flex items-center gap-[14px]">
                <div class="flex text-right flex-col gap-0.5">
                    <p class="text-sm text-secondary">Howdy,</p>
                    <p class="font-semibold">Sarina Dwi</p>
                </div>
                <div class="flex rounded-full size-[50px] overflow-hidden">
                    <img src="assets/images/photos/profile.png" class="w-full h-full object-cover" alt="photo">
                </div>
            </div>
            <ul class="hidden absolute top-full mt-[10px] right-0 flex flex-col w-[170px] shrink-0 h-fit text-left rounded-xl border border-outline py-5 px-5 bg-white shadow-[0px_10px_30px_0px_#B8B8B840] gap-[14px]">
                <li>
                    <a href="#" class="hover:text-info transition-all duration-300">Rewards</a>
                </li>
                <li>
                    <a href="my-mortgages.html" class="hover:text-info transition-all duration-300">My Mortgages</a>
                </li>
                <li>
                    <a href="#" class="hover:text-info transition-all duration-300">Learn Property</a>
                </li>
                <li>
                    <a href="#" class="hover:text-info transition-all duration-300">Settings</a>
                </li>
                <li>
                    <a href="index.html" class="hover:text-info transition-all duration-300">Logout</a>
                </li>
            </ul>
        </button>
    </div>
</section>
