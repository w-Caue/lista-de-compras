@props([
    'type' => 'button',
])

<x-buttons
    {{ $attributes->merge(['class' => 'text-purple-500 bg-purple-200 focus:outline-purple ease-linear duration-300 transition-all hover:scale-95']) }}>
    {{ $slot }}
</x-buttons>
