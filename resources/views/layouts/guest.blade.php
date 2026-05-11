<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YKIP - Secangkir Kopi untuk Pendidikan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Base typography */
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>

<body class="antialiased bg-[#FDFBF7] text-gray-900 flex flex-col min-h-screen">
    
    <nav class="bg-[#9B663A] w-full px-6 py-2 flex items-center justify-between shadow-md sticky top-0 z-50">
        
        <div class="w-32 flex-shrink-0 flex items-center">
            <a href="https://donasipendidikan.com/">
                <img src="{{ asset('logo-navbar.png') }}" alt="YKIP Logo" class="h-10 w-auto">
            </a>
        </div>

        <div class="hidden md:flex flex-1 justify-center space-x-8 text-white font-medium text-sm md:text-base">
            
            <!-- <a href="https://donasipendidikan.com/" 
            target="_blank" 
            rel="noopener noreferrer" 
            class="hover:text-[#F3E5D8] transition-colors">
                Home
            </a> -->
            
            <a href="https://ykip.org/id/" 
            target="_blank" 
            rel="noopener noreferrer" 
            class="hover:text-[#F3E5D8] transition-colors">
                Visit Us
            </a>
            
            <a href="https://donasipendidikan.com/#about" class="hover:text-[#F3E5D8] transition-colors">About</a>        
        </div>

        <div class="w-32 flex justify-end flex-shrink-0">
            <a href="{{ route('donation.form') }}" class="bg-[#C99856] text-white px-6 py-2 rounded-full font-bold shadow hover:bg-[#b88645] transition-colors">
                Donasi
            </a>
        </div>
    </nav>

    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <footer class="w-full text-white mt-auto">
        <div class="bg-[#402011] w-full py-16 px-6">
            <div class="max-w-5xl mx-auto flex flex-col items-center">
                <div class="flex flex-col items-center mb-10">
                    <img src="{{ asset('logo-footer.png') }}" alt="YKIP Footer Logo" class="h-20 w-auto mb-4">
                </div>
                
                <div class="flex flex-col md:flex-row justify-center items-start gap-12 md:gap-20 w-full text-sm">
                    <div class="flex items-start gap-4">
                        <div class="bg-[#C99856] p-2 rounded-full flex-shrink-0"><svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg></div>
                        <div>
                            <p class="font-bold text-white mb-1">Email</p>
                            <a href="https://ykip.org/id/" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="text-gray-300">
                                    info@ykip.org
                            </a>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 max-w-xs">
                        <div class="bg-[#C99856] p-2 rounded-full flex-shrink-0"><svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg></div>
                        <div>
                            <p class="font-bold text-white mb-1">Address</p>
                            <p class="text-gray-300">Jalan By Pass Ngurah Rai Gang Mina Utama No 1. Suwung, Sesetan, Denpasar Selatan,<br>Kota Denpasar, Bali 80223</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="bg-[#C99856] p-2 rounded-full flex-shrink-0"><svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg></div>
                        <div>
                            <p class="font-bold text-white mb-1">Phone</p>
                            <p class="text-gray-300">011-534-8798-6556</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#9B663A] w-full py-4 px-6 text-sm">
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                
                <div class="text-center md:text-left text-[#F3E5D8]">
                    &copy; 2026 YKIP - Hak Cipta Dilindungi.
                </div>
                
                <div class="flex justify-center items-center">

                    <img src="{{ asset('logo-navbar.png') }}" alt="YKIP Logo" class="h-10 w-auto">

                </div>

                <div class="flex justify-center md:justify-end gap-5">
                    <a href="https://www.instagram.com/ykip_bali/" class="text-white hover:text-gray-200 transition-colors"
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="hover:text-[#F3E5D8] transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    
                    <a href="https://www.facebook.com/YKIPBali" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="hover:text-[#F3E5D8] transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>