<x-app-layout>
    <div class="py-4 flex flex-col min-h-screen bg-white">

        {{-- Profile Header --}}
        <div class="container max-w-4xl mx-auto px-4 py-6 space-y-10">
            <div class="px-10 flex gap-20 md:flex-row items-center">

                {{-- Profile Picture --}}
                <div class="relative">
                    <div class="w-20 h-20 md:w-36 md:h-36 rounded-full overflow-hidden border-2 border-gray-200 bg-gray-300 flex items-center justify-center">
                        <x-iconoir-camera class="w-8 h-8 text-gray-500" />
                    </div>
                </div>

                {{-- Profile Info --}}
                <div class="flex flex-col w-full">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-4">
                        <h1 class="text-xl font-normal">{{ Auth::user()->username ?? 'username' }}</h1>
                        <div class="flex gap-2">
                            <button onclick="window.location.href='/setting'" class="h-9 px-4 rounded-lg text-sm font-semibold border border-gray-300 bg-gray-100">Edit profile</button>
                            <button href="#" class="h-9 px-4 rounded-lg text-sm font-semibold border border-gray-300 bg-gray-100">View archive</button>
                            <button 
                                onclick="window.location.href='/setting'"
                                class="h-9 w-9 rounded-full flex items-center justify-center">
                                <x-iconoir-settings class="h-5 w-5" />
                            </button>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="flex justify-center md:justify-start gap-8 my-4">
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

                    {{-- Name --}}
                    <div class="text-center md:text-left">
                        <h2 class="font-semibold">{{ Auth::user()->bio }}</h2>
                    </div>
                </div>
            </div>

            {{-- New Post Button --}}
            <div class="flex justify-start">
                <button href="{{ route('feeds.create') }}" class="rounded-full size-20 flex flex-col items-center justify-center gap-1 border">
                    <x-iconoir-plus class="h-6 w-6 text-gray-400" />
                    <span class="text-xs">New</span>
                </button>
            </div>
        </div>

        <div x-data="{ activeTab: 'posts' }" class="w-full max-w-4xl mx-auto mt-10">
            <!-- Tabs Navigation -->
            <div class="flex w-full justify-center border-b">
                <button
                    @click="activeTab = 'posts'"
                    :class="activeTab === 'posts' ? 'border-b-2 border-black' : ''"
                    class="flex items-center gap-2 px-4 py-3">
                    <x-iconoir-view-grid class="h-4 w-4" />
                    <span class="uppercase text-xs font-semibold">Posts</span>
                </button>
                <button
                    @click="activeTab = 'saved'"
                    :class="activeTab === 'saved' ? 'border-b-2 border-black' : ''"
                    class="flex items-center gap-2 px-4 py-3">
                    <x-iconoir-bookmark class="h-4 w-4" />
                    <span class="uppercase text-xs font-semibold">Archived</span>
                </button>
                <button
                    @click="activeTab = 'tagged'"
                    :class="activeTab === 'tagged' ? 'border-b-2 border-black' : ''"
                    class="flex items-center gap-2 px-4 py-3">
                    <x-iconoir-hashtag class="h-4 w-4" />
                    <span class="uppercase text-xs font-semibold">Tagged</span>
                </button>
            </div>

            @if ($feeds && $feeds->isNotEmpty())
            <div class="w-full py-5 grid grid-cols-3 gap-2">
                @foreach ($feeds as $feed)
                <!-- Tab Content -->
                <div class="w-full relative aspect-square bg-gray-100">
                    <img
                        src="{{ asset('storage/' . $feed->media_path) ?? '/placeholder.svg' }}"
                        alt="Post {{ $feed->id }}"
                        class="w-full h-full object-cover" />
                    <div class="absolute top-2 right-2 text-white">
                        <!-- Icon here, you can replace with your own -->
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- No feeds available - display empty content -->
            <div class="mt-8 px-4">
                <div x-show="activeTab === 'posts'" class="flex flex-col items-center justify-center py-8">
                    <div class="border border-gray-300 rounded-full p-4 mb-4">
                        <x-iconoir-camera class="h-8 w-8 text-gray-900" />
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Share Photos</h3>
                    <p class="text-gray-600 text-center mb-4">When you share photos, they will appear on your profile.</p>
                    <button class="text-blue-500 font-semibold">Share your first photo</button>
                </div>

                <div x-show="activeTab === 'saved'" class="flex flex-col items-center justify-center py-8">
                    <h3 class="text-xl font-bold mb-2">Saved</h3>
                    <p class="text-gray-600 text-center">Save photos and videos that you want to see again.</p>
                </div>

                <div x-show="activeTab === 'tagged'" class="flex flex-col items-center justify-center py-8">
                    <h3 class="text-xl font-bold mb-2">Tagged</h3>
                    <p class="text-gray-600 text-center">When people tag you in photos, they'll appear here.</p>
                </div>
            </div>
            @endif

            {{-- Footer --}}
            <footer class="mt-auto py-8 text-xs text-gray-500">
                <div class="max-w-4xl mx-auto px-4">
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mb-4">
                        @foreach (['Meta','About','Blog','Jobs','Help','API','Privacy','Terms','Locations','Instagram Lite','Threads','Contact Uploading & Non-Users','Meta Verified','Meta in Indonesia'] as $item)
                        <a href="#" class="hover:underline">{{ $item }}</a>
                        @endforeach
                    </div>
                    <div class="flex justify-center items-center gap-2">
                        <select class="bg-transparent text-gray-500 text-xs border-none focus:ring-0">
                            <option>English</option>
                        </select>
                        <span>© 2025 Instagram from Meta</span>
                    </div>
                </div>
            </footer>
        </div>
</x-app-layout>