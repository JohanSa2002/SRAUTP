@props(['hover' => true, 'padding' => 'p-8'])

<div {{ $attributes->merge(['class' => "glass-card rounded-[2.5rem] relative overflow-hidden transition-all duration-500 " . ($hover ? "hover:bg-white hover:shadow-2xl hover:shadow-cyber-purple-500/10 hover:border-cyber-purple-100 border-2 border-transparent" : "")]) }}>
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-cyber-purple-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="relative z-10 {{ $padding }}">
        {{ $slot }}
    </div>
</div>
