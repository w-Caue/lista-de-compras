@props([
    'type' => 'button', 'color'
])

<x-buttons
    {{ $attributes->merge(['class' => 'text-blue-500 bg-transparent border-2 border-solid border-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-600 outline-none focus:outline-none ease-linear transition-all duration-150 transition-all duration-300 hover:scale-95']) }}>
    {{ $slot }}
</x-buttons>
