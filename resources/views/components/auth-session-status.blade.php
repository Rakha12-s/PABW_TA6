@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm font-medium text-sky-700']) }}>
        {{ $status }}
    </div>
@endif
