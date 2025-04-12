<div
    :class="{
        'grid-cols-2': {{ $user->setting->feeds_per_row }} === 2,
        'grid-cols-3': {{ $user->setting->feeds_per_row }} === 3,
        'grid-cols-4': {{ $user->setting->feeds_per_row }} === 4,
        'grid-cols-5': {{ $user->setting->feeds_per_row }} === 5,
    }"
    class="w-full py-5 grid gap-2"
>
    <template x-for="feed in feeds" :key="feed.id">
        <template x-if="!feed.archived">
            <button
                class="w-full relative aspect-square bg-gray-100"
                @click="selectedFeed = feed; showModal = true;">
                <template x-if="feed.media_type.startsWith('photo')">
                    <img
                        :src="`/storage/${feed.media_path}`"
                        class="w-full h-full object-cover" />
                </template>
                <template x-if="feed.media_type.startsWith('video')">
                    <video
                        :src="`/storage/${feed.media_path}`"
                        class="w-full h-full object-cover"
                        autoplay muted loop playsinline>
                        Your browser does not support the video tag.
                    </video>
                </template>
            </button>
        </template>
    </template>

    <template x-if="feeds.filter(f => !f.archived).length === 0">
        <p class="text-center col-span-3">No posts available.</p>
    </template>
</div>
