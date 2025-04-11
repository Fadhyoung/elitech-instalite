<section>
    <div
        x-show="showModal"
        @click="closeModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak x-transition>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 bg-white" @click.stop>

            <!-- LEFT SIDE -->
            <div class="bg-black">
                <img x-bind:src="'/storage/' + selectedFeed.media_path" alt="Profile Photo" class="w-full h-full min-w-[250px] min-h-[200px] object-cover" />
                <button class="absolute right-3 top-1/2 bg-white/30 rounded-full p-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L16 12L9 19" stroke="white" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                    </svg>
                </button>
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
                                <span class="font-semibold">{{ $user->username }}</span> <p x-text="selectedFeed?.caption"></p>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action buttons and likes -->
                <div class="border-t p-4">
                    <div class="flex justify-between mb-2">
                        <div class="flex gap-4">
                            <button>
                                <x-iconoir-archive />
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <button @click="closeModal" class="absolute p-10 top-0 right-0 text-white">Close</button>
        </div>
    </div>
</section>