@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center border-b-2 border-sky-500 px-1 pt-1 text-sm font-medium leading-5 text-sky-800 transition duration-150 ease-in-out focus:border-sky-700 focus:outline-none'
            : 'inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium leading-5 text-slate-500 transition duration-150 ease-in-out hover:border-sky-200 hover:text-sky-700 focus:border-sky-300 focus:text-sky-700 focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
