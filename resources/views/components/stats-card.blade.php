@props(['label', 'value', 'icon', 'color' => 'purple'])

@php
    $iconClasses = [
        'purple' => 'bg-purple-50 text-cyber-purple-600 group-hover:bg-cyber-purple-600',
        'orange' => 'bg-orange-50 text-orange-600 group-hover:bg-orange-600',
        'pink' => 'bg-pink-50 text-pink-600 group-hover:bg-pink-600',
        'indigo' => 'bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600',
    ][$color] ?? $iconClasses['purple'];
@endphp

<x-card class="group">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $label }}</p>
            <h4 class="text-3xl font-black text-gray-900 mt-1">{{ $value }}</h4>
        </div>
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-500 group-hover:scale-110 group-hover:text-white shadow-inner {{ $iconClasses }}">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        </div>
    </div>
</x-card>
