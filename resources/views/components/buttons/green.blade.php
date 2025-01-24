@props([
    'type' => 'button',
])

<x-buttons
    {{ $attributes->merge(['class' => 'text-green-500 bg-green-200 focus:outline-green ease-linear duration-300 transition-all hover:scale-95']) }}>
    {{ $slot }}
</x-buttons>
