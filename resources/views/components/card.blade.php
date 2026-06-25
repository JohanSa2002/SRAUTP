@props(['hover' => true, 'padding' => 'p-8'])

<div {{ $attributes->merge(['class' => "bg-white border border-gray-100 shadow-sm rounded-2xl relative overflow-hidden transition-[transform,box-shadow,border-color] duration-200 ease-out-strong " . ($hover ? "hover:shadow-md hover:-translate-y-0.5 hover:border-uni-gold-300/50" : "")]) }}>
    <div class="absolute top-0 right-0 -mt-24 -mr-24 w-72 h-72 bg-uni-purple-400/[0.04] rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="relative z-10 {{ $padding }}">
        {{ $slot }}
    </div>
</div>
