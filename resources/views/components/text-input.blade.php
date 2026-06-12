@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 bg-white rounded-xl shadow-sm min-h-[44px] placeholder:text-gray-400 transition duration-150 focus:border-uni-navy-400 focus:ring-2 focus:ring-uni-navy-400/25 disabled:bg-gray-50 disabled:text-gray-500 disabled:cursor-not-allowed']) }}>
