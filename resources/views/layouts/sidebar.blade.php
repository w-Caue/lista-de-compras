<!-- DESKTOP -->
<div class="flex justify-between">

    <div
        class="flex-shrink-0 bg-white transition-all duration-300 mx-5 my-4 rounded-lg shadow-lg shadow-gray-300 p-4 hidden lg:block dark:bg-gray-800 dark:shadow-gray-700">

        <div
            class="text-2xl font-black text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-500">
            My List
        </div>
        <div class="relative justify-center items-center mt-4 space-y-4 text-sm font-bold tracking-widest">

            <div class="border dark:border-gray-700"></div>

            {{-- HOME --}}
            <a href="{{ route('listagem') }}"
                class="relative w-full flex justify-between items-center space-x-2 p-2 cursor-pointer {{ request()->routeIs('listagem') ? 'text-blue-500 border-l-2 border-blue-500 ' : 'text-gray-400 hover:text-blue-500' }}">
                <div class="w-full flex flex-col justify-center items-center">
                    <x-icons.listagem class="size-6" />

                    <h1>
                        Listas
                    </h1>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /DESKTOP -->

<!-- Mobile -->
<div class="flex justify-between ">

    <div class="fixed z-50 flex-shrink-0 space-y-2 mx-4 my-4 p-2 h-full rounded-lg transition-all duration-300 bg-white lg:hidden dark:bg-gray-800"
        x-bind:class="{
            'top-0 left-0 w-56': sidebar
                .navOpen,
            'top-0 -left-80': !sidebar.navOpen
        }">

        <div class="flex items-center justify-between gap-2 ">
            <div
                class="text-2xl font-black text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-300">
                My List
            </div>

            <button x-on:click="sidebar.navOpen = !sidebar.navOpen"
                class="block lg:hidden focus:outline-none dark:text-white">
                <!-- Close Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6" x-bind:class="sidebar.navOpen ? '' : 'hidden'">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="relative mt-4 space-y-4 uppercase text-sm font-bold tracking-widest">

            <div class="border dark:border-gray-700"></div>

            {{-- HOME --}}
            <a href="{{ route('listagem') }}"
                class="relative w-full flex justify-between items-center space-x-2 p-2 cursor-pointer {{ request()->routeIs('listagem') ? 'text-blue-500 border-l-2 border-blue-500 ' : 'text-gray-400 hover:text-blue-500' }}">
                <div class="w-full flex gap-2 items-center">
                    <x-icons.listagem class="size-6" />

                    <h1>
                        Listas
                    </h1>
                </div>
            </a>
        </div>
    </div>
</div>
