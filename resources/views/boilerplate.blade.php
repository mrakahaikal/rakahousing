<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Responsive</title>
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="font-poppins text-[#0A090B]">
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
        class="fixed inset-0 z-20 bg-surface-dark/10 backdrop-blur-xs md:hidden"
        aria-hidden="true"
        x-on:click="sidebarIsOpen = false"
        x-transition.opacity
    ></div>
    <!-- Sidebar -->
    <div
        x-cloak
        x-bind:class="sidebarIsOpen ? 'translate-x-0' : '-translate-x-90'"
        id="sidebar"
        class="overflow-y-auto w-[270px] flex-col shrink-0 justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB] fixed left-0 z-30 flex h-svh border-outline transition-transform duration-300 md:translate-x-0 md:relative"
    >
        <div class="w-full flex flex-col gap-[30px]">
            <a href="index.html" class="flex items-center justify-center">
                <img src="assets/images/logo/logo.svg" alt="logo" />
            </a>
            <ul class="flex flex-col gap-3">
                <li>
                    <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/home-hashtag.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            Overview
                        </p>
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/note-favorite.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold text-white transition-all duration-300 hover:text-white"
                        >
                            Courses
                        </p>
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/profile-2user.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            Students
                        </p>
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/sms-tracking.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            Messages
                        </p>
                        <div
                            class="notif w-5 h-5 flex shrink-0 rounded-full items-center justify-center bg-[#F6770B]"
                        >
                            <p class="font-bold text-[10px] leading-[15px] text-white">
                                12
                            </p>
                        </div>
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/chart-2.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            Analytics
                        </p>
                    </a>
                </li>
            </ul>
            <ul class="flex flex-col gap-3">
                <li>
                    <h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/3dcube.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            Rewards
                        </p>
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/code.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            A.I Plugins
                        </p>
                    </a>
                </li>
                <li>
                    <a
                        href=""
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/setting-2.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            Settings
                        </p>
                    </a>
                </li>
                <li>
                    <a
                        href="signin.html"
                        class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]"
                    >
                        <div>
                            <img src="assets/images/icons/security-safe.svg" alt="icon" />
                        </div>
                        <p
                            class="font-semibold transition-all duration-300 hover:text-white"
                        >
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </div>
        <a href="">
            <div
                class="w-full flex gap-3 items-center p-4 rounded-[14px] bg-[#0A090B] mt-[30px]"
            >
                <div>
                    <img src="assets/images/icons/crown-round-bg.svg" alt="icon" />
                </div>
                <div class="flex flex-col gap-[2px]">
                    <p class="font-semibold text-white">Get Pro</p>
                    <p class="text-sm leading-[21px] text-[#A0A0A0]">
                        Unlock features
                    </p>
                </div>
            </div>
        </a>
    </div>

    <!-- top navbar & main content  -->
    <div class="h-svh w-full overflow-y-auto">
        <!-- top navbar  -->
        <div
            class="nav flex gap-2 items-center justify-between p-5 border-b border-[#EEEEEE]"
        >
            <!-- sidebar toggle button for small screens  -->
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
            <form
                class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]"
            >
                <input
                    type="text"
                    class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                    placeholder="Search by report, student, etc"
                    name="search"
                />
                <button
                    type="submit"
                    class="ml-[10px] w-8 h-8 flex items-center justify-center"
                >
                    <img src="assets/images/icons/search.svg" alt="icon" />
                </button>
            </form>
            <div class="flex items-center gap-4 md:gap-[30px]">
                <div class="flex gap-[14px]">
                    <a
                        href=""
                        class="size-8 md:size-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]"
                    >
                        <img src="assets/images/icons/receipt-text.svg" alt="icon" />
                    </a>
                    <a
                        href=""
                        class="size-8 md:size-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]"
                    >
                        <img src="assets/images/icons/notification.svg" alt="icon" />
                    </a>
                </div>
                <div
                    class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"
                ></div>
                <div class="flex gap-3 items-center">
                    <div class="md:flex flex-col text-right hidden">
                        <p class="text-sm text-[#7F8190]">Howdy</p>
                        <p class="font-semibold">Fany Alqo</p>
                    </div>
                    <div class="size-8 md:size-[46px]">
                        <img src="assets/images/photos/default-photo.svg" alt="photo" />
                    </div>
                </div>
            </div>
        </div>

        <!-- main content  -->
        <div id="main-content" class="p-4">
            <div class="overflow-y-auto">
                <!-- Add main content here  -->
                <div class="flex flex-col px-5 mt-5">
                    <div class="w-full flex justify-between items-center">
                        <div class="flex flex-col gap-1">
                            <p class="font-extrabold text-[30px] leading-[45px]">
                                Manage Course
                            </p>
                            <p class="text-[#7F8190]">
                                Provide high quality for best students
                            </p>
                        </div>
                        <a
                            href="new-course.html"
                            class="h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D]"
                        >Add New Course</a
                        >
                    </div>
                </div>
                <div
                    class="course-list-container flex flex-col px-5 mt-[30px] gap-[30px]"
                >
                    <div
                        class="course-list-header flex flex-nowrap justify-between pb-4 pr-10 border-b border-[#EEEEEE]"
                    >
                        <div class="flex shrink-0 w-[300px]">
                            <p class="text-[#7F8190]">Course</p>
                        </div>
                        <div class="flex justify-center shrink-0 w-[150px]">
                            <p class="text-[#7F8190]">Date Created</p>
                        </div>
                        <div class="flex justify-center shrink-0 w-[170px]">
                            <p class="text-[#7F8190]">Category</p>
                        </div>
                        <div class="flex justify-center shrink-0 w-[120px]">
                            <p class="text-[#7F8190]">Action</p>
                        </div>
                    </div>
                    <div class="list-items flex flex-nowrap justify-between pr-10">
                        <div class="flex shrink-0 w-[300px]">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full"
                                >
                                    <img
                                        src="assets/images/thumbnail/Basic-Interview.png"
                                        class="object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-bold text-lg">Interview</p>
                                    <p class="text-[#7F8190]">Beginners</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex shrink-0 w-[150px] items-center justify-center"
                        >
                            <p class="font-semibold">22 August 2024</p>
                        </div>
                        <div
                            class="flex shrink-0 w-[170px] items-center justify-center"
                        >
                            <p
                                class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B]"
                            >
                                Product Design
                            </p>
                        </div>
                        <div class="flex shrink-0 w-[120px] items-center">
                            <div class="relative h-[41px]">
                                <div
                                    class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]"
                                >
                                    <button
                                        onclick="toggleMaxHeight(this)"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        menu
                                        <img
                                            src="assets/images/icons/arrow-down.svg"
                                            alt="icon"
                                        />
                                    </button>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Manage
                                    </a>
                                    <a
                                        href="course-students.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Students
                                    </a>
                                    <a
                                        href="course-details.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Edit Course
                                    </a>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full text-[#FD445E]"
                                    >
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-items flex flex-nowrap justify-between pr-10">
                        <div class="flex shrink-0 w-[300px]">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full"
                                >
                                    <img
                                        src="assets/images/thumbnail/UIUX-1.png"
                                        class="object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-bold text-lg">Intro to Full-Stack</p>
                                    <p class="text-[#7F8190]">Beginners</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex shrink-0 w-[150px] items-center justify-center"
                        >
                            <p class="font-semibold">11 March 2024</p>
                        </div>
                        <div
                            class="flex shrink-0 w-[170px] items-center justify-center"
                        >
                            <p
                                class="p-[8px_16px] rounded-full bg-[#EAE8FE] font-bold text-sm text-[#6436F1]"
                            >
                                Programming
                            </p>
                        </div>
                        <div class="flex shrink-0 w-[120px] items-center">
                            <div class="relative h-[41px]">
                                <div
                                    class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]"
                                >
                                    <button
                                        onclick="toggleMaxHeight(this)"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        menu
                                        <img
                                            src="assets/images/icons/arrow-down.svg"
                                            alt="icon"
                                        />
                                    </button>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Manage
                                    </a>
                                    <a
                                        href="course-students.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Students
                                    </a>
                                    <a
                                        href="course-details.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Edit Course
                                    </a>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full text-[#FD445E]"
                                    >
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-items flex flex-nowrap justify-between pr-10">
                        <div class="flex shrink-0 w-[300px]">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full"
                                >
                                    <img
                                        src="assets/images/thumbnail/Digital-Marketing-101.png"
                                        class="object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-bold text-lg">Digital Marketing 101</p>
                                    <p class="text-[#7F8190]">Beginners</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex shrink-0 w-[150px] items-center justify-center"
                        >
                            <p class="font-semibold">11 March 2024</p>
                        </div>
                        <div
                            class="flex shrink-0 w-[170px] items-center justify-center"
                        >
                            <p
                                class="p-[8px_16px] rounded-full bg-[#D5EFFE] font-bold text-sm text-[#066DFE]"
                            >
                                Marketing
                            </p>
                        </div>
                        <div class="flex shrink-0 w-[120px] items-center">
                            <div class="relative h-[41px]">
                                <div
                                    class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]"
                                >
                                    <button
                                        onclick="toggleMaxHeight(this)"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        menu
                                        <img
                                            src="assets/images/icons/arrow-down.svg"
                                            alt="icon"
                                        />
                                    </button>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Manage
                                    </a>
                                    <a
                                        href="course-students.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Students
                                    </a>
                                    <a
                                        href="course-details.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Edit Course
                                    </a>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full text-[#FD445E]"
                                    >
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-items flex flex-nowrap justify-between pr-10">
                        <div class="flex shrink-0 w-[300px]">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full"
                                >
                                    <img
                                        src="assets/images/thumbnail/UIUX-2.png"
                                        class="object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-bold text-lg">Usability-Testing</p>
                                    <p class="text-[#7F8190]">Beginners</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex shrink-0 w-[150px] items-center justify-center"
                        >
                            <p class="font-semibold">30 June 2024</p>
                        </div>
                        <div
                            class="flex shrink-0 w-[170px] items-center justify-center"
                        >
                            <p
                                class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B]"
                            >
                                Product Design
                            </p>
                        </div>
                        <div class="flex shrink-0 w-[120px] items-center">
                            <div class="relative h-[41px]">
                                <div
                                    class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]"
                                >
                                    <button
                                        onclick="toggleMaxHeight(this)"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        menu
                                        <img
                                            src="assets/images/icons/arrow-down.svg"
                                            alt="icon"
                                        />
                                    </button>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Manage
                                    </a>
                                    <a
                                        href="course-students.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Students
                                    </a>
                                    <a
                                        href="course-details.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Edit Course
                                    </a>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full text-[#FD445E]"
                                    >
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-items flex flex-nowrap justify-between pr-10">
                        <div class="flex shrink-0 w-[300px]">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-16 h-16 flex shrink-0 overflow-hidden rounded-full"
                                >
                                    <img
                                        src="assets/images/thumbnail/Web-Development.png"
                                        class="object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-bold text-lg">Web Development</p>
                                    <p class="text-[#7F8190]">Beginners</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex shrink-0 w-[150px] items-center justify-center"
                        >
                            <p class="font-semibold">30 June 2024</p>
                        </div>
                        <div
                            class="flex shrink-0 w-[170px] items-center justify-center"
                        >
                            <p
                                class="p-[8px_16px] rounded-full bg-[#EAE8FE] font-bold text-sm text-[#6436F1]"
                            >
                                Programming
                            </p>
                        </div>
                        <div class="flex shrink-0 w-[120px] items-center">
                            <div class="relative h-[41px]">
                                <div
                                    class="menu-dropdown w-[120px] max-h-[41px] overflow-hidden absolute top-0 p-[10px_16px] bg-white flex flex-col gap-3 border border-[#EEEEEE] transition-all duration-300 hover:shadow-[0_10px_16px_0_#0A090B0D] rounded-[18px]"
                                >
                                    <button
                                        onclick="toggleMaxHeight(this)"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        menu
                                        <img
                                            src="assets/images/icons/arrow-down.svg"
                                            alt="icon"
                                        />
                                    </button>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Manage
                                    </a>
                                    <a
                                        href="course-students.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Students
                                    </a>
                                    <a
                                        href="course-details.html"
                                        class="flex items-center justify-between font-bold text-sm w-full"
                                    >
                                        Edit Course
                                    </a>
                                    <a
                                        href="#"
                                        class="flex items-center justify-between font-bold text-sm w-full text-[#FD445E]"
                                    >
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pagiantion" class="flex gap-4 items-center mt-[37px] px-5">
                    <button
                        class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]"
                    >
                        1
                    </button>
                    <button
                        class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]"
                    >
                        2
                    </button>
                    <button
                        class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-white bg-[#0A090B]"
                    >
                        3
                    </button>
                    <button
                        class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]"
                    >
                        4
                    </button>
                    <button
                        class="flex items-center justify-center border border-[#EEEEEE] rounded-full w-10 h-10 font-semibold transition-all duration-300 hover:text-white hover:bg-[#0A090B] text-[#7F8190]"
                    >
                        5
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
