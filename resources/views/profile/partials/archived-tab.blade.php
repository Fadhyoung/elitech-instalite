<div @class([ 'w-full py-5 grid gap-2' , 'grid-cols-2'=> $user->columns_preference == 2,
    'grid-cols-3' => $user->columns_preference == 3,
    'grid-cols-4' => $user->columns_preference == 4,
    'grid-cols-5' => $user->columns_preference == 5,
    ])>
    @forelse ($feeds as $feed)
    @if ($feed->archived)
    <button
        class="w-full relative aspect-square bg-gray-100"
        @click="openModal(@js($feed))">
        @if (Str::startsWith($feed->media_type, 'photo'))
        <img
            src="{{ asset('storage/' . $feed->media_path) ?? '/placeholder.svg' }}"
            alt="Post {{ $feed->id }}"
            class="w-full h-full object-cover" />
        @elseif (Str::startsWith($feed->media_type, 'video'))
        <video
            src="{{ asset('storage/' . $feed->media_path) }}"
            class="w-full h-full object-cover"
            autoplay muted loop playsinline>
            Your browser does not support the video tag.
        </video>
        @else
        <div class="w-full h-full flex items-center justify-center text-sm text-gray-500">
            Unsupported Media
        </div>
        @endif
    </button>
    @endif
    @empty
    <p class="text-center col-span-3">No archived posts.</p>
    @endforelse
</div>