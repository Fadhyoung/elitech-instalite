<section>
    <div
        x-show="showModal"
        @click="closeModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak x-transition>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 bg-white" @click.stop>

            <!-- LEFT SIDE -->
            <div class="bg-black">
                <template x-if="selectedFeed.media_type.startsWith('photo')">
                    <img x-bind:src="'/storage/' + selectedFeed.media_path" class="w-full h-auto object-cover" />
                </template>

                <template x-if="selectedFeed.media_type.startsWith('video')">
                    <video
                        x-bind:src="'/storage/' + selectedFeed.media_path"
                        class="w-full h-auto object-cover"
                        autoplay
                        muted
                        loop
                        playsinline>
                        Your browser does not support the video tag.
                    </video>
                </template>

            </div>

            <!-- RIGHT SIDE -->
            <div class="relative flex flex-col h-full">

                <!-- Caption and content -->
                <div class="p-4 overflow-y-auto flex-grow">
                    <!-- Main caption -->
                    <div class="flex items-start gap-2 mb-4">
                        <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $user->photo_profile) }}" alt="Profile Photo" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <div class="flex gap-5 items-center text-sm">
                                <span class="font-semibold">{{ $user->username }}</span>
                                <p x-text="selectedFeed?.caption"></p>

                            </div>
                        </div>
                    </div>
                </div>



                <!-- COMMENT SECTION -->
                <div class="flex flex-col">
                    <!-- Action buttons and likes -->
                    <div class="flex justify-between mb-2 border-t p-4">
                        <div class="flex gap-4">
                            <!-- Archive Button (only show if not archived) -->
                            <button x-show="!selectedFeed.archived" @click="archiveFeed(selectedFeed.id)">
                                <x-iconoir-archive />
                            </button>

                            <!-- Unarchive Button (only show if archived) -->
                            <button x-show="selectedFeed.archived" @click="unarchiveFeed(selectedFeed.id)">
                                unarchive
                            </button>
                        </div>
                    </div>
                </div>
                <div x-data="{ comment: '' }" class="px-5 flex items-center justify-between py-2 border-t p-4">
                    <button class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                    </button>
                    <div class="flex items-center flex-1">
                        <input
                            type="text"
                            placeholder="Add a comment..."
                            class="flex-1 border-none outline-none text-sm focus:ring-0"
                            x-model="comment" />
                    </div>
                    <button
                        :class="comment.length > 0 ? 'text-sm font-semibold text-blue-500' : 'text-sm font-semibold text-blue-300'"
                        :disabled="comment.length === 0">
                        Post
                    </button>
                </div>
            </div>
            <button @click="closeModal" class="absolute p-10 top-0 right-0 text-white">Close</button>
        </div>
    </div>
</section>