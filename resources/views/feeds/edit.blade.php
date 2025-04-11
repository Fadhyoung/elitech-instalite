<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Feed
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-10">
        <form method="POST" action="{{ route('feeds.update', $feed->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label>Caption</label>
                <input type="text" name="caption" class="w-full border p-2 rounded" value="{{ $feed->caption }}">
            </div>
            <div>
                <label>Current Media:</label>
                @if ($feed->media_type === 'photo')
                <img src="{{ asset('storage/' . $feed->media_path) }}" width="200">
                @elseif ($feed->media_type === 'video')
                <video width="320" height="240" controls>
                    <source src="{{ asset('storage/' . $feed->media_path) }}">
                    Your browser does not support the video tag.
                </video>
                @endif
            </div>
            <div class="mb-4">
                <label>Media (leave empty to keep current)</label>
                <input type="file" name="media_path" class="w-full">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>