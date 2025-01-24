@aware(['type'])

<button type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
            'px-2 py-2 text-sm font-semibold uppercase tracking-widest leading-5 transition-colors duration-150 rounded-md focus:outline-blue focus:shadow-outline-blue transition-all',
    ]) }}>
    {{ $slot }}
</button>
