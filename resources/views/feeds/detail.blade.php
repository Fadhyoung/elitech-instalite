<x-app-layout>
    <div class="w-full h-full p-10 bg-white">

        <div class="w-1/2 mx-auto grid grid-cols-1 md:grid-cols-2 border bg-white">

            <!-- LEFT SIDE -->
            <div class="bg-black">
                @if (strpos($feed->media_type, 'photo') === 0)
                <img src="{{ asset('storage/' . $feed->media_path) }}" class="w-full h-auto object-cover" />
                @elseif (strpos($feed->media_type, 'video') === 0)
                <video src="{{ asset('storage/' . $feed->media_path) }}" class="w-full h-auto object-cover" autoplay muted loop playsinline>
                    Your browser does not support the video tag.
                </video>
                @endif
            </div>

            <!-- RIGHT SIDE -->
            <div class="h-full relative flex flex-col gap-0">

                <div class="h-full flex flex-col gap-0 flex-grow bg">
                    <div class="p-4 flex items-start gap-2 border-b">
                        <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                            @if ($user)
                            <img src="{{ asset('storage/' . $user->photo_profile) }}" alt="Profile Photo" class="w-full h-full object-cover" />
                            @else
                            <p>No profile photo available.</p>
                            @endif
                        </div>
                        <div>
                            <div class="flex gap-5 items-center text-sm">
                                <span class="font-semibold">{{ $user->username }}</span>
                                <p>{{ $feed->caption }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- DISPLAY COMMENTS -->
                    <div class="p-4">
                        @forelse ($feed->comments as $comment)
                        <div class="flex items-start gap-2 group hover:bg-gray-50 p-2 rounded relative">
                            <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                                <img src="{{ $comment->user->photo_profile ? asset('storage/' . $comment->user->photo_profile) : asset('/placeholder.png') }}" alt="Profile Photo" class="w-full h-full object-cover" />
                            </div>

                            <div class="flex gap-2 text-sm">
                                <span class="font-semibold">{{ $comment->user->name }}</span>
                                <p>{{ $comment->comment }}</p>
                            </div>

                            <button @click="deleteComment({{ $comment->id }})" class="absolute right-2 top-2 text-red-500 hover:text-red-700 text-xs hidden group-hover:inline">
                                Delete
                            </button>
                        </div>
                        @empty
                        <div class="text-gray-500 text-sm">No comments yet.</div>
                        @endforelse
                    </div>

                </div>

                <!-- COMMENT SECTION -->
                <div class="flex flex-col">
                    <div class="flex justify-between mb-2 border-t p-4">
                        <div class="flex gap-4">
                            @if ($feed->archived)
                            <button @click="unarchiveFeed({{ $feed->id }})" class="text-gray-500 hover:text-gray-700">
                                Unarchive
                            </button>
                            @else
                            <button @click="archiveFeed({{ $feed->id }})" class="text-gray-500 hover:text-gray-700">
                                Archive
                            </button>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="px-5 flex items-center justify-between py-2 border-t p-4">
                    <button class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                    </button>

                    <div class="flex items-center flex-1">
                        <input type="text" placeholder="Add a comment..." class="flex-1 border-none outline-none text-sm focus:ring-0" />
                    </div>

                    <button class="text-sm font-semibold text-blue-300" disabled>
                        Post
                    </button>
                </div>

            </div>

            <button class="absolute p-10 top-0 right-0 text-white">Close</button>
        </div>
    </div>
</x-app-layout>