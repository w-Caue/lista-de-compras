@aware(['error'])

@props(['value', 'name', 'for'])

<select
    {{ $attributes->class([
        'block p-2 text-xs uppercase font-semibold tracking-widest w-full rounded-lg border-gray-300 dark:focus:border-blue-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input',
        'border-red-500' => $error,
    ]) }}
    @isset($name) name="{{ $name }}" @endif
    @isset($value) value="{{ $value }}" @endif
    {{ $attributes }}>
    {{ $slot }}
</select>
