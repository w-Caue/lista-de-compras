@props([
    'type' => 'button',
])

<x-buttons
    {{ $attributes->merge(['class' => 'text-orange-500 bg-orange-200 focus:outline-orange ease-linear duration-300 transition-all hover:scale-95']) }}>
    {{ $slot }}
</x-buttons>
