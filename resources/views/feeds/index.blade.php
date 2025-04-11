<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feeds') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">All Feeds</h1>

                    <a href="{{ route('feeds.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create New Feed</a>

                    <div>
                        @foreach ($feeds as $feed)
                        <a href="{{ route('feeds.edit', $feed) }}" class="text-blue-500">Edit</a>

                        <form action="{{ route('feeds.destroy', $feed->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure? want to delete data id')">Delete</button>
                        </form>

                        <div class="border rounded p-4 mb-20 shadow-sm">
                            <h2 class="font-semibold">{{ $feed->username }}</h2>
                            <p class="text-gray-700">{{ $feed->caption }}</p>
                            @if ($feed->media_path)
                            <img src="{{ asset('storage/' . $feed->media_path) }}" alt="Feed Image" class="mt-2 w-64">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>