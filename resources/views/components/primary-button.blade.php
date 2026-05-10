<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[#3E2723] border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90 focus:bg-opacity-90 active:bg-opacity-100 focus:outline-none focus:ring-2 focus:ring-[#D4A373] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md']) }}>
    {{ $slot }}
</button>
