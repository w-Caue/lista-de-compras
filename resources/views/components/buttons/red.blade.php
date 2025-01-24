@props([
    'type' => 'button',
])

<x-buttons
    {{ $attributes->merge(['class' => 'text-red-500 bg-red-200 focus:outline-red ease-linear duration-300 transition-all hover:scale-95']) }}>
    {{ $slot }}
</x-buttons>
