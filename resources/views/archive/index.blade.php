<x-app-layout>
    <div class="w-full px-8 mx-auto p-6 bg-white">
        <h1 class="text-2xl font-bold mb-6">Archived Posts</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('archive.index') }}" class="flex flex-wrap items-end gap-4 mb-6">
            <div>
                <label for="from" class="block text-sm font-medium text-gray-700">From</label>
                <input type="date" name="from" id="from" value="{{ request('from') }}" class="border rounded-md px-3 py-1">
            </div>

            <div>
                <label for="to" class="block text-sm font-medium text-gray-700">To</label>
                <input type="date" name="to" id="to" value="{{ request('to') }}" class="border rounded-md px-3 py-1">
            </div>
            
            <x-primary-button>{{ __('Filter') }}</x-primary-button>

            <div class="ml-auto flex gap-2">
                <x-link-button
                    href="{{ route('archive.export.xlsx', ['date' => request('date')]) }}"
                    variant="primary">
                    Export XLSX
                </x-link-button>

                <x-link-button
                    href="{{ route('archive.export.pdf', ['date' => request('date')]) }}"
                    variant="primary">
                    Export PDF
                </x-link-button>
            </div>
        </form>

        <!-- Table -->
        <div class="overflow-auto">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-2 border">Media</th>
                        <th class="p-2 border">Caption</th>
                        <th class="p-2 border">Post Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($feeds as $feed)
                    @if ($feed->archived)
                    <tr class="border-b">
                        <td class="p-2 border w-48">
                            @if (Str::startsWith($feed->media_type, 'photo'))
                            <img src="{{ asset('storage/' . $feed->media_path) }}" class="w-full h-auto">
                            @elseif (Str::startsWith($feed->media_type, 'video'))
                            <video src="{{ asset('storage/' . $feed->media_path) }}" class="w-full h-auto" controls preload="metadata" muted></video>
                            @else
                            <span class="text-gray-500">Unsupported</span>
                            @endif
                        </td>
                        <td class="p-2 border align-top">{{ $feed->caption }}</td>
                        <td class="p-2 border align-top">{{ $feed->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">No archived posts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>