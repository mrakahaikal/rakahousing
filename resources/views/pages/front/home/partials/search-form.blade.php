<?php

$search = function() {
    return true;
}

?>

<div>
    <form wire:submit.prevent="search" class="relative flex w-full max-w-[940px] rounded-3xl p-5 gap-5 bg-white border border-outline shadow-[0px_8px_30px_0px_#06092208] mx-auto mt-auto">
        <div class="flex flex-col w-full max-w-[241px] gap-2 h-[84px]">
            <p class="font-semibold">Location</p>
            <label class="relative">
                <select name="" id="" class="appearance-none outline-none w-full rounded-full ring-1 ring-primary py-[14px] px-5 font-semibold invalid:font-normal focus:ring-2 focus:ring-info transition-all duration-300" required>
                    <option value="" hidden disabled selected>Choose your location</option>
                    <option value="1">Jakarta Pusat</option>
                    <option value="1">Bandung</option>
                    <option value="1">Bekasi</option>
                </select>
                <img src="assets/images/icons/arrow-down.svg" class="absolute size-5 transform -translate-y-1/2 top-1/2 right-5" alt="icon">
            </label>
        </div>
        <div class="flex flex-col w-full max-w-[227px] gap-2 h-[84px]">
            <p class="font-semibold">Category</p>
            <label class="relative">
                <select name="" id="" class="appearance-none outline-none w-full rounded-full ring-1 ring-primary py-[14px] px-5 font-semibold invalid:font-normal focus:ring-2 focus:ring-info transition-all duration-300" required>
                    <option value="" hidden disabled selected>Select Category</option>
                    <option value="1">Man Made</option>
                    <option value="1">Beaches</option>
                </select>
                <img src="assets/images/icons/arrow-down.svg" class="absolute size-5 transform -translate-y-1/2 top-1/2 right-5" alt="icon">
            </label>
        </div>
        <div class="flex flex-col w-full max-w-[232px] gap-2 h-[84px]">
            <p class="font-semibold">Property</p>
            <label class="relative">
                <select name="" id="" class="appearance-none outline-none w-full rounded-full ring-1 ring-primary py-[14px] px-5 font-semibold invalid:font-normal focus:ring-2 focus:ring-info transition-all duration-300" required>
                    <option value="" hidden disabled selected>Select property type</option>
                    <option value="1">House</option>
                </select>
                <img src="assets/images/icons/arrow-down.svg" class="absolute size-5 transform -translate-y-1/2 top-1/2 right-5" alt="icon">
            </label>
        </div>
        <button type="submit" class="group rounded-full border py-[14px] px-5 flex items-center bg-success mt-auto">
            <span class="font-semibold text-nowrap">Find Houses</span>
        </button>
    </form>
</div>
