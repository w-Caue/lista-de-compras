@aware(['error'])

@props(['for', 'value'])

<span for="{{ $for ?? '' }}"
    {{ $attributes->merge([
        'class' => 'text-gray-500 text-md sm:text-sm uppercase font-bold tracking-widest',
        'text-red-500' => $error, //condição, caso true, mostra text-red-500
    ]) }}>{{ $value }}
</span>
