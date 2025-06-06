<nav class="w-full h-full bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="w-full h-full p-5 flex lg:flex-col xs:flex-row justify-between lg:items-start xs:items-center">

        <div class="lg:flex xs:hidden flex-col gap-7">
            <div class="w-full">
                <img src="{{ asset('images/img_instalite.png') }}"
                    alt="Instagram Mobile Mockup"
                    class="size-36 object-contain object-left" />
            </div>

            <!-- FEATURES -->
            <div class="flex gap-5">
                <x-iconoir-profile-circle />
                <button onclick="window.location.href='/profile'">
                    Profile
                </button>
            </div>
            <div class="flex gap-5">
                <x-iconoir-archive />
                <button onclick="window.location.href='/archive'">
                    Archive
                </button>
            </div>
            <div class="flex gap-5">
                <x-iconoir-plus />
                <button onclick="window.postForm.toggleModal(true)">Create</button>
            </div>
        </div>

        <!-- HAMBURGER -->
        <div class="relative xs:flex lg:hidden">
            <div class="-me-2 flex items-center lg:hidden">
                <button onclick="document.getElementById('customDropdown2').classList.toggle('hidden')"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="customDropdown2" class="p-2 absolute bottom-full mb-2 left-0 bg-white dark:bg-gray-800 shadow-lg rounded-md hidden z-50">
                <div class="flex flex-col gap-5">
                    <div class="flex gap-5">
                        <x-iconoir-profile-circle />
                        <button onclick="window.location.href='/profile'">
                            Profile
                        </button>
                    </div>
                    <div class="flex gap-5">
                        <x-iconoir-video-camera />
                        <button onclick="window.location.href='/feeds'">
                            Feeds
                        </button>
                    </div>
                    <div class="flex gap-5">
                        <x-iconoir-archive />
                        <button onclick="window.location.href='/archive'">
                            Archive
                        </button>
                    </div>
                    <div class="flex gap-5">
                        <x-iconoir-plus />
                        <button onclick="window.postForm.toggleModal(true)">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SETTING -->
        <div class=" relative">
            <button onclick="document.getElementById('customDropdown').classList.toggle('hidden')"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                <div>More</div>
                <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <div id="customDropdown" class="absolute bottom-full mb-2 lg:left-0 xs:right-0 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-md py-1 hidden z-50">
                <a href="{{ route('setting.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Setting</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                </form>
            </div>
        </div>
        
    </div>
</nav>