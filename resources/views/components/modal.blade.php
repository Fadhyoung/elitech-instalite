@props([
    'id' => 'modal'
])

<div
    id="{{ $id }}"
    x-show="showModal"
    x-transition
    class="w-full fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center"
    @click.self="toggleModal(false)"
>
    <div
        class="bg-white w-fit rounded-lg shadow-lg relative"
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
    <button class="absolute top-10 right-10 text-white" @click="toggleModal(false)">Close</button>
</div>
