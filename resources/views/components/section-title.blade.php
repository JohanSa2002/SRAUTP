@props(['subtitle' => null])

<div {{ $attributes->merge(['class' => 'mb-8']) }}>
    <h3 class="academic-heading text-2xl md:text-3xl font-bold text-uni-navy-900">
        {{ $slot }}
    </h3>
    <div class="gold-rule-short mt-3" aria-hidden="true"></div>
    @if($subtitle)
        <p class="mt-3 text-gray-500 text-sm leading-relaxed max-w-xl">{{ $subtitle }}</p>
    @endif
</div>
