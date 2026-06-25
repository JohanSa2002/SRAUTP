<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 min-h-[44px] bg-uni-gold-400 border border-transparent rounded-xl font-semibold text-sm text-uni-purple-950 transition-[transform,background-color,box-shadow] duration-150 ease-out-strong hover:bg-uni-gold-300 hover:shadow-md hover:shadow-uni-gold-400/25 active:scale-[0.97] focus:outline-none focus-visible:ring-2 focus-visible:ring-uni-gold-500 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>
