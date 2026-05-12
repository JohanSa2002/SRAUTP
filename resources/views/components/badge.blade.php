@props(['type' => 'purple'])

@php
    $classes = [
        'purple' => 'bg-cyber-purple-50 text-cyber-purple-600 border-cyber-purple-100',
        'indigo' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
        'pink' => 'bg-pink-50 text-pink-600 border-pink-100',
        'orange' => 'bg-orange-50 text-orange-600 border-orange-100',
        'green' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
        'blue' => 'bg-blue-50 text-blue-600 border-blue-100',
    ][$type] ?? $classes['purple'];
@endphp

<span {{ $attributes->merge(['class' => "px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border " . $classes]) }}>
    {{ $slot }}
</span>
