@props([
    'href',
    'variant' => 'primary',
])

@php
    $base = 'inline-flex items-center justify-center font-medium transition-all focus:outline-none';
    $variants = [
        'primary' => 'bg-black text-white hover:bg-blue-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700',
        // Add more as needed
    ];
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "$base " . (isset($variants[$variant]) ? $variants[$variant] : $variants['primary']) . " px-4 py-2 rounded"]) }}
>
    {{ $slot }}
</a>
