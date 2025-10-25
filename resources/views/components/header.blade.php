<header>
    <nav class="relative w-full flex items-center justify-center px-[75px]">
        <div class="fixed top-0 flex items-center justify-between w-full max-w-[1130px] rounded-3xl p-4 bg-white mt-[30px] z-30">
            <a href="{{ route('front.index') }}" wire:navigate class="flex shrink-0 items-center gap-2">
                <x-application-logo class="block h-9 w-auto fill-current text-primary" />
                {{ config('app.name') }}
            </a>
            <ul class="flex items-center gap-[30px]">
                <x-nav-link :href="route('front.index')" :active="request()->routeIs('front.index')" wire:navigate>
                    Home
                </x-nav-link>
                <x-nav-link :href="route('front.category.index')" :active="request()->routeIs('front.category.index')" wire:navigate>
                    Browse
                </x-nav-link>
                <li class="group">
                    <a href="#" class="hover:font-bold group-[.active]:font-bold transition-all duration-300">Rewards</a>
                </li>
                <li class="group">
                    <a href="#" class="hover:font-bold group-[.active]:font-bold transition-all duration-300">Stories</a>
                </li>
            </ul>
            <div class="flex items-center gap-3">
                <a href="signin.html" class="group rounded-full border border-primary py-[14px] px-5 hover:bg-primary flex items-center transition-all duration-300">
                    <span class="font-semibold group-hover:text-white transition-all duration-300">Sign In</span>
                </a>
                <a href="signup.html" class="group rounded-full border py-[14px] px-5 flex items-center bg-success">
                    <span class="font-semibold">Sign Up</span>
                </a>
            </div>
        </div>
    </nav>
</header>
