@props([
    'id' => 'modal',
    'show' => false, // default hidden
])

<div
    id="{{ $id }}"
    class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center {{ $show ? '' : 'hidden' }}"
    onclick="document.getElementById('{{ $id }}').classList.add('hidden')"
>
    <div
        class="bg-white w-fit  rounded-lg shadow-lg relative"
        onclick="event.stopPropagation()"
    >
        {{-- Header Slot --}}
        <div class="w-full h-full">
            {{ $header ?? '' }}
        </div>

        {{-- Body Slot --}}
        <div class="w-full h-full">
            {{ $body ?? '' }}
        </div>

        {{-- Footer Slot --}}
        <div class="flex justify-end">
            {{ $footer ?? '' }}
        </div>        
    </div>

    <!-- BUTTON -->
    <button class="absolute top-10 right-10 text-white" onclick="toggleModal('createModal', false)">Close</button>
</div>
