@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#D4A373] focus:ring-[#D4A373] rounded-md shadow-sm']) }}>
