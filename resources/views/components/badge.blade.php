@props(['type' => 'navy'])

@php
    $classes = [
        'navy'   => 'bg-uni-navy-100 text-uni-navy-700 border-uni-navy-200',
        'gold'   => 'bg-uni-gold-100 text-uni-gold-700 border-uni-gold-200',
        /* Legacy aliases — map old keys to accessible variants */
        'purple' => 'bg-uni-navy-100 text-uni-navy-700 border-uni-navy-200',
        'indigo' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
        'pink'   => 'bg-pink-50 text-pink-700 border-pink-200',
        'orange' => 'bg-orange-50 text-orange-700 border-orange-200',
        'green'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'blue'   => 'bg-blue-50 text-blue-700 border-blue-200',
        'red'    => 'bg-red-50 text-red-700 border-red-200',
    ][$type] ?? 'bg-uni-navy-100 text-uni-navy-700 border-uni-navy-200';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border " . $classes]) }}>
    {{ $slot }}
</span>
