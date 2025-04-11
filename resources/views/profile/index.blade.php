<x-app-layout>
    <div class="py-4 flex flex-col min-h-screen bg-white">

        {{-- Profile Header --}}
        @include('profile.partials.profile-bar')

        <div
            x-data="{
                activeTab: 'posts',
                selectedFeed: null,
                showModal: false,
                openModal(feed) {
                    this.selectedFeed = feed;
                    this.showModal = true;
                },
                closeModal() {
                    this.showModal = false;
                    this.selectedFeed = null;
                }
            }"

            class="w-full max-w-4xl mx-auto mt-10">

            <!-- Tabs Navigation -->selectedFeed
            <div class="flex w-full justify-center border-b">
                <button
                    @click="activeTab = 'posts'"
                    :class="activeTab === 'posts' ? 'border-b-2 border-black' : ''"
                    class="flex items-center gap-2 px-4 py-3">
                    <x-iconoir-view-grid class="h-4 w-4" />
                    <span class="uppercase text-xs font-semibold">Posts</span>
                </button>
                <button
                    @click="activeTab = 'archived'"
                    :class="activeTab === 'archived' ? 'border-b-2 border-black' : ''"
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

            <!-- POSTS TAB -->
            <div x-show="activeTab === 'posts'" class="w-full py-5 grid grid-cols-3 gap-2">
                @forelse ($feeds as $feed)
                @if (!$feed->archived)
                <button
                    class="w-full relative aspect-square bg-gray-100"
                    @click="openModal(@js($feed))">
                    <img
                        src="{{ asset('storage/' . $feed->media_path) ?? '/placeholder.svg' }}"
                        alt="Post {{ $feed->id }}"
                        class="w-full h-full object-cover" />
                </button>

                @endif
                @empty
                <p class="text-center col-span-3">No posts available.</p>
                @endforelse
            </div>

            <!-- SAVED / ARCHIVED TAB -->
            <div x-show="activeTab === 'archived'" class="w-full py-5 grid grid-cols-3 gap-2">
                @forelse ($feeds as $feed)
                @if ($feed->archived)
                <button class="w-full relative aspect-square bg-gray-100">
                    <img
                        src="{{ asset('storage/' . $feed->media_path) ?? '/placeholder.svg' }}"
                        alt="Archived {{ $feed->id }}"
                        class="w-full h-full object-cover" />
                </button>
                @endif
                @empty
                <p class="text-center col-span-3">No archived posts.</p>
                @endforelse
            </div>

            <!-- TAGGED TAB -->
            <div x-show="activeTab === 'tagged'" class="w-full py-5 text-center">
                <p>On progress...</p>
            </div>

            @else
            <!-- No feeds available - display empty content -->
            <div class="mt-8 px-4">
                <div x-show="activeTab === 'posts'" class="flex flex-col items-center justify-center text-center py-8">
                    <form method="POST" action="{{ route('feeds.store') }}" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <input
                            type="file"
                            name="media_path"
                            accept="image/*,video/*"
                            class="hidden"
                            id="mediaInput"
                            onchange="document.getElementById('uploadForm').submit();">

                        <div class="w-fit border border-gray-300 rounded-full p-4 mb-4 justify-self-center">
                            <x-iconoir-camera class="h-8 w-8 text-gray-900" />
                        </div>

                        <h3 class="text-2xl font-bold mb-2">Share Photos</h3>
                        <p class="text-gray-600 text-center mb-4">
                            When you share photos, they will appear on your profile.
                        </p>

                        <button
                            type="button"
                            class="text-blue-500 font-semibold"
                            onclick="document.getElementById('mediaInput').click();">
                            Share your first photo
                        </button>
                    </form>

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

            <!-- MODAL -->
            <div
                x-show="showModal"
                @click="showModal = false"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg w-full max-w-lg relative" @click.stop>
                    <p x-text="selectedFeed?.caption"></p>
                    <button @click="closeModal" class="mt-4 text-red-500">Close</button>
                </div>
            </div>


        </div>
</x-app-layout>