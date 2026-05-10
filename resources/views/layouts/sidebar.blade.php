<!-- Mobile Sidebar Overlay -->
<div x-show="sidebarOpen" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden" @click="sidebarOpen = false" x-transition.opacity></div>

<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-[#3E2723] overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 shadow-xl border-r border-[#D4A373] border-opacity-20 flex flex-col">
    <div class="flex items-center justify-center mt-8 px-6">
        <div class="flex items-center gap-3">
            <svg class="w-10 h-10 text-[#D4A373]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
            <span class="text-white text-2xl mx-2 font-serif font-bold tracking-wider">YKIP Admin</span>
        </div>
    </div>

    <nav class="mt-10 flex-1 px-4 space-y-2">
        <a class="flex items-center px-4 py-3 text-gray-100 transition-colors rounded-xl hover:bg-[#D4A373] hover:bg-opacity-20 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-[#D4A373] bg-opacity-30 text-white font-semibold' : '' }}" href="{{ route('admin.dashboard') }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <span class="mx-4">Dashboard</span>
        </a>

        <a class="flex items-center px-4 py-3 text-gray-100 transition-colors rounded-xl hover:bg-[#D4A373] hover:bg-opacity-20 hover:text-white {{ request()->routeIs('admin.donations.*') ? 'bg-[#D4A373] bg-opacity-30 text-white font-semibold' : '' }}" href="{{ route('admin.donations.index') }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="mx-4">Donations</span>
        </a>

        <a class="flex items-center px-4 py-3 text-gray-100 transition-colors rounded-xl hover:bg-[#D4A373] hover:bg-opacity-20 hover:text-white {{ request()->routeIs('admin.donors.*') ? 'bg-[#D4A373] bg-opacity-30 text-white font-semibold' : '' }}" href="{{ route('admin.donors.index') }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="mx-4">Donors</span>
        </a>

        <a class="flex items-center px-4 py-3 text-gray-100 transition-colors rounded-xl hover:bg-[#D4A373] hover:bg-opacity-20 hover:text-white {{ request()->routeIs('admin.packages.*') ? 'bg-[#D4A373] bg-opacity-30 text-white font-semibold' : '' }}" href="{{ route('admin.packages.index') }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <span class="mx-4">Packages</span>
        </a>

        <a class="flex items-center px-4 py-3 text-gray-100 transition-colors rounded-xl hover:bg-[#D4A373] hover:bg-opacity-20 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-[#D4A373] bg-opacity-30 text-white font-semibold' : '' }}" href="{{ route('admin.users.index') }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="mx-4">Staff Users</span>
        </a>
    </nav>
    
    <div class="px-6 py-6 border-t border-[#D4A373] border-opacity-20 text-xs text-[#D4A373] text-center opacity-60">
        YKIP Admin Panel v1.0
    </div>
</div>
