@aware(['error'])

@props(['value', 'name', 'for', 'title'])


<textarea rows="4"
    {{ $attributes->class([
        'block p-2 text-xs uppercase font-semibold tracking-widest w-full dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded border border-2',
        'border-red-500' => $error,
    ]) }}
    @isset($name) name="{{ $name }}" @endif
        type="text"
        @isset($value) value="{{ $value }}" @endif
    {{ $attributes }}> 
</textarea>
