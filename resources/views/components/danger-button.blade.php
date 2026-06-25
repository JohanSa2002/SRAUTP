<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 min-h-[44px] bg-red-600 border border-transparent rounded-xl font-semibold text-sm text-white transition-[transform,background-color] duration-150 ease-out-strong hover:bg-red-500 active:bg-red-700 active:scale-[0.97] focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none']) }}>
    {{ $slot }}
</button>
