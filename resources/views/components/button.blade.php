@php
$base = 'flex gap-2 items-center justify-center font-medium focus:outline-none transition-all';

$variants = [
'primary' => 'bg-white border-darkBlue text-darkBlue',
'secondary' => 'bg-midBlue border-amber text-white',
'tertiary' => 'bg-darkBlue border-amber',
'accent' => 'bg-amber border-midBlue',
'info' => 'bg-sky-100 text-sky-700 border-sky-300',
'success' => 'bg-green-500 text-white border-green-700',
'warning' => 'bg-yellow-400 text-black border-yellow-600',
'danger' => 'bg-red-600 text-white border-red-800',
];

$contrast = [
'primary' => 'text-darkBlue',
'secondary' => 'text-white',
'tertiary' => 'text-white',
'accent' => 'text-darkBlue',
'info' => 'text-sky-700',
'success' => 'text-white',
'warning' => 'text-black',
'danger' => 'text-white',
'default' => 'text-black',
];

$types = [
'solid' => $variants[$variant] . ' ' . $contrast[$variant],
'outline' => 'border ' . $contrast[$variant],
'subtle' => $variants[$variant] . ' bg-opacity-50 ' . $contrast[$variant],
'ghost' => 'bg-transparent ' . $contrast[$variant],
'link' => 'bg-transparent underline p-0 text-midBlue',
'icon' => 'p-2 rounded-full ' . $contrast[$variant],
'elevated' => $variants[$variant] . ' ' . $contrast[$variant] . ' lg:shadow-md hover:shadow-lg',
];

$sizes = [
'xs' => 'px-2 py-1 text-xs',
'sm' => 'xs:px-2 xs:py-1 xs:text-xs lg:px-3 lg:py-1.5 lg:text-sm',
'md' => 'xs:px-3 xs:py-1.5 xs:text-sm lg:px-4 lg:py-2 lg:text-base',
'lg' => 'xs:px-4 xs:py-2 xs:text-base lg:px-5 lg:py-3 lg:text-lg',
'xl' => 'xs:px-5 xs:py-3 xs:text-lg lg:px-8 lg:py-5 lg:text-xl',
];

$radiusStyles = [
'none' => 'rounded-none',
'xs' => 'rounded-sm',
'sm' => 'rounded',
'md' => 'rounded-md',
'lg' => 'rounded-lg',
'xl' => 'rounded-xl',
'full' => 'rounded-full',
];

$visibility = [
'mobile-only' => 'md:hidden flex',
'desktop-only' => 'hidden md:flex',
'all' => 'block',
];

$isDisabled = $attributes->get('disabled') || $isLoading;
$finalClasses = implode(' ', [
$base,
$types[$buttonType] ?? '',
$sizes[$size] ?? '',
$radiusStyles[$radius] ?? '',
$visibility[$visibleOn] ?? '',
$isDisabled ? 'opacity-50 cursor-not-allowed' : '',
$attributes->get('class'),
]);
@endphp

<button
    {{ $attributes->merge(['class' => $finalClasses]) }}
    @if($isDisabled) disabled @endif>
    @if($isLoading && $loadingPosition === 'left')
    <span class="mr-2 animate-spin">🔄</span>
    @endif

    @if(isset($startIcon))
    <span class="mr-2">{{ $startIcon }}</span>
    @endif

    @if(isset($icon))
    {{ $icon }}
    @else
    {{ $isLoading ? $labelLoading : ($slot->isEmpty() ? $label : $slot) }}
    @endif

    @if(isset($endIcon))
    <span class="ml-2">{{ $endIcon }}</span>
    @endif

    @if($isLoading && $loadingPosition === 'right')
    <span class="ml-2 animate-spin">🔄</span>
    @endif
</button>