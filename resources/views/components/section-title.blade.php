@props(['subtitle' => null])

<div {{ $attributes->merge(['class' => 'mb-8']) }}>
    <h3 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight uppercase">
        <span class="tech-gradient-text">{{ $slot }}</span>
    </h3>
    @if($subtitle)
        <p class="mt-2 text-gray-500 font-medium tracking-tight">{{ $subtitle }}</p>
    @endif
</div>
