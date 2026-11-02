@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-md border-sky-200 bg-white shadow-sm focus:border-sky-500 focus:ring-sky-500']) }}>
