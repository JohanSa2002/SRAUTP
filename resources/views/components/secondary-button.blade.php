<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 min-h-[44px] bg-white border border-uni-purple-200 rounded-xl font-semibold text-sm text-uni-purple-800 shadow-sm transition-[transform,background-color,border-color] duration-150 ease-out-strong hover:bg-uni-purple-50 hover:border-uni-purple-300 active:scale-[0.97] focus:outline-none focus-visible:ring-2 focus-visible:ring-uni-purple-400 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>
