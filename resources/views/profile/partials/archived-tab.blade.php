<div
    :class="{
        'w-full py-5 grid gap-2': true,
        'grid-cols-2': {{ $user->setting->feeds_per_row == 2 ? 'true' : 'false' }},
        'grid-cols-3': {{ $user->setting->feeds_per_row == 3 ? 'true' : 'false' }},
        'grid-cols-4': {{ $user->setting->feeds_per_row == 4 ? 'true' : 'false' }},
        'grid-cols-5': {{ $user->setting->feeds_per_row == 5 ? 'true' : 'false' }},
    }"
>
    <template x-for="feed in feeds.filter(f => f.archived)" :key="feed.id">
        <button
            class="w-full relative aspect-square bg-gray-100"
            @click="openModal(feed)">
            
            <template x-if="feed.media_type.startsWith('photo')">
                <img
                    :src="feed.media_path ? '/storage/' + feed.media_path : '/placeholder.svg'"
                    :alt="'Post ' + feed.id"
                    class="w-full h-full object-cover" />
            </template>

            <template x-if="feed.media_type.startsWith('video')">
                <video
                    :src="'/storage/' + feed.media_path"
                    class="w-full h-full object-cover"
                    autoplay muted loop playsinline>
                    Your browser does not support the video tag.
                </video>
            </template>

            <template x-if="!feed.media_type.startsWith('photo') && !feed.media_type.startsWith('video')">
                <div class="w-full h-full flex items-center justify-center text-sm text-gray-500">
                    Unsupported Media
                </div>
            </template>
        </button>
    </template>

    <template x-if="feeds.filter(f => f.archived).length === 0">
        <p class="text-center col-span-3">No archived posts.</p>
    </template>
</div>
