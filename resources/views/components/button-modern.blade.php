@props(['variant' => 'primary'])

@php
    $variants = [
        'primary'   => 'bg-uni-gold-400 text-uni-navy-950 shadow-md shadow-uni-gold-400/20 hover:bg-uni-gold-300 hover:shadow-lg hover:shadow-uni-gold-400/30 hover:-translate-y-0.5 focus-visible:ring-uni-gold-500',
        'secondary' => 'bg-uni-navy-800 text-white hover:bg-uni-navy-700 hover:-translate-y-0.5 focus-visible:ring-uni-navy-500',
        'outline'   => 'bg-transparent text-uni-navy-800 border-2 border-uni-navy-200 hover:border-uni-navy-400 hover:bg-uni-navy-50 focus-visible:ring-uni-navy-400',
    ];
    $variantClass = $variants[$variant] ?? $variants['primary'];
@endphp

<button {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-2 px-7 py-3.5 min-h-[44px] rounded-xl font-semibold text-sm transition-all duration-200 active:scale-[0.98] focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none " . $variantClass]) }}>
    {{ $slot }}
</button>
