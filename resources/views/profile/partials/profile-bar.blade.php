<section>
    <div class="container max-w-4xl mx-auto px-4 py-6 space-y-10">
        <div class="lg:px-10 xs:px-0 flex lg:gap-20 xs:gap-5 lg:flex-row xs:flex-col items-center">

            <!-- PROFILE PICTURE -->
            <div class="relative">
                <div class="w-20 h-20 md:w-36 md:h-36 rounded-full overflow-hidden border-2 border-gray-200 bg-gray-300 flex items-center justify-center">
                    @if (auth()->user()->photo_profile)
                    <img src="{{ asset('storage/' . $user->photo_profile) }}" alt="Profile Photo" class="w-full h-full object-cover">
                    @else
                    <svg class="w-8 h-8 text-gray-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" fill="#6B7280" />
                        <path d="M12 13C7.58172 13 4 16.5817 4 21H20C20 16.5817 16.4183 13 12 13Z" fill="#6B7280" />
                    </svg>
                    @endif
                </div>
            </div>

            <!-- PROFILE INFO -->
            <div class="w-full flex flex-col lg:gap-0 xs:gap-5">
                <div class="w-full flex flex-col md:flex-row items-center md:items-start gap-4 ">
                    <h1 class="text-xl font-normal">{{ Auth::user()->username ?? 'username' }}</h1>
                    <div class="flex gap-2">
                        <button onclick="window.location.href='/setting'" class="h-9 px-5 rounded-lg text-sm font-semibold border border-gray-300 bg-gray-100">Edit profile</button>
                        <button onclick="window.location.href='/archive'" class="h-9 px-5 rounded-lg text-sm font-semibold border border-gray-300 bg-gray-100">View archive</button>
                        <button
                            onclick="window.location.href='/setting'"
                            class="h-9 w-9 rounded-full flex items-center justify-center">
                            <x-iconoir-settings class="h-5 w-5" />
                        </button>
                    </div>
                </div>

                <div class="lg:flex xs:hidden justify-center md:justify-start gap-8 my-4">
                    <div class="flex gap-1">
                        <span class="font-semibold">0</span> posts
                    </div>
                    <div class="flex gap-1">
                        <span class="font-semibold">5</span> followers
                    </div>
                    <div class="flex gap-1">
                        <span class="font-semibold">30</span> following
                    </div>
                </div>

                <div class="text-center md:text-left">
                    <h2 class="font-semibold">{{ Auth::user()->bio }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>