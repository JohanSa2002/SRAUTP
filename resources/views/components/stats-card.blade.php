@props(['label', 'value', 'icon', 'color' => 'navy', 'href' => null])

@php
    $iconClasses = [
        'navy'   => 'bg-uni-purple-50 text-uni-purple-600 group-hover:bg-uni-purple-700',
        'gold'   => 'bg-uni-gold-50 text-uni-gold-600 group-hover:bg-uni-gold-500',
        /* Legacy aliases */
        'purple' => 'bg-uni-purple-50 text-uni-purple-600 group-hover:bg-uni-purple-700',
        'orange' => 'bg-orange-50 text-orange-600 group-hover:bg-orange-600',
        'pink'   => 'bg-rose-50 text-rose-600 group-hover:bg-rose-600',
        'indigo' => 'bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600',
    ][$color] ?? 'bg-uni-purple-50 text-uni-purple-600 group-hover:bg-uni-purple-700';

    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => 'group block bg-white border border-gray-100 shadow-sm rounded-2xl relative overflow-hidden transition-[transform,box-shadow,border-color] duration-200 ease-out-strong hover:shadow-md hover:-translate-y-0.5 hover:border-uni-gold-300/50' . ($href ? ' cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-uni-gold-500 focus-visible:ring-offset-2' : '')]) }}>
    <div class="absolute top-0 right-0 -mt-24 -mr-24 w-72 h-72 bg-uni-purple-400/[0.04] rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="relative z-10 p-6 flex items-center justify-between gap-4">
        <div class="min-w-0">
            <p class="academic-label text-gray-400">{{ $label }}</p>
            <h4 class="text-2xl font-serif font-bold text-uni-purple-900 mt-1.5 truncate">{{ $value }}</h4>
            @if($href)
                <span class="inline-flex items-center gap-1 mt-2 text-xs font-semibold text-uni-gold-600 opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 group-focus-visible:opacity-100 group-focus-visible:translate-x-0 transition-[opacity,transform] duration-150 ease-out-strong">
                    Ir ahora
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </span>
            @endif
        </div>
        <div class="w-14 h-14 flex-shrink-0 rounded-2xl flex items-center justify-center transition-[transform,background-color,color] duration-200 ease-out-strong group-hover:scale-105 group-hover:text-white shadow-inner {{ $iconClasses }}" aria-hidden="true">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        </div>
    </div>
</{{ $tag }}>
