<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 min-h-[44px] bg-white border border-uni-navy-200 rounded-xl font-semibold text-sm text-uni-navy-800 shadow-sm transition-all duration-200 hover:bg-uni-navy-50 hover:border-uni-navy-300 active:scale-[0.98] focus:outline-none focus-visible:ring-2 focus-visible:ring-uni-navy-400 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>
