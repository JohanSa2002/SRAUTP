@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 bg-white rounded-xl shadow-sm min-h-[44px] placeholder:text-gray-400 transition-[border-color,box-shadow] duration-150 focus:border-uni-purple-400 focus:ring-2 focus:ring-uni-purple-400/25 disabled:bg-gray-50 disabled:text-gray-500 disabled:cursor-not-allowed']) }}>
