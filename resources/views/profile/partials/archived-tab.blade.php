<div class="w-full py-5 grid grid-cols-3 gap-2">
    @forelse ($feeds as $feed)
    @if ($feed->archived)
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
    <p class="text-center col-span-3">No archived posts.</p>
    @endforelse
</div>