<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Feed
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-10">
        <form method="POST" action="{{ route('feeds.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label>Caption</label>
                <input type="text" name="caption" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label>Media</label>
                <input type="file" name="media_path" class="w-full">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post</button>
        </form>
    </div>
</x-app-layout>
