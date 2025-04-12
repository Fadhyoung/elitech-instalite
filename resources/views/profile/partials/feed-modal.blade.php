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

                <!-- Action buttons and likes -->
                <div class="border-t p-4">
                    <div class="flex justify-between mb-2">
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

            </div>
            <button @click="closeModal" class="absolute p-10 top-0 right-0 text-white">Close</button>
        </div>
    </div>
</section>