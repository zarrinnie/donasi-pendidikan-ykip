<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YKIP - Spare your change, Save the Children</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
</head>
<body class="font-sans antialiased text-gray-800 bg-white">

    <nav class="absolute top-0 left-0 w-full z-50 px-6 py-4 lg:px-16 flex justify-between items-center text-white">
        <div class="flex items-center gap-2">
            <div class="text-2xl font-bold tracking-wider flex items-center gap-2">
                <span class="text-yellow-400 text-3xl">𓅰</span> ykip
            </div>
        </div>
        <div class="hidden lg:flex items-center gap-8 text-sm font-medium">
            <a href="{{ route('landing') }}" class="hover:text-yellow-400 transition">Home</a>
            <a href="#" class="hover:text-yellow-400 transition">Sponsor</a>
            <a href="#" class="hover:text-yellow-400 transition">About</a>
            <a href="{{ route('donation.form') }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded-full font-bold hover:bg-yellow-500 transition">Make Donation</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-[#8C6239] text-white py-16 text-center">
        <div class="max-w-4xl mx-auto px-6 flex flex-col items-center">
            <div class="text-4xl mb-4">𓅰 <span class="font-bold">ykip</span></div>
            <h2 class="text-3xl font-bold text-[#F4B41A] mb-2 tracking-widest">YKIP DONATES</h2>
            <p class="text-sm opacity-80 mb-8">Yayasan Kemanusiaan Ibu Pertiwi</p>
            
            <p class="text-sm opacity-80 max-w-md mx-auto mb-12">
                YKIP Bali, Karang Anyar Shopping Complex No. 2<br>
                Sunset Road, Kuta, Kabupaten Badung, Bali 80361<br>
                +62 812 3456 7890
            </p>
            
            <div class="flex justify-between w-full items-center text-xs opacity-70 border-t border-white/20 pt-8">
                <p>&copy; 2024 YKIP - Hak Cipta Dilindungi.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white">FB</a>
                    <a href="#" class="hover:text-white">IG</a>
                    <a href="#" class="hover:text-white">X</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger);

            // Simple fade-up animation for elements with .gsap-reveal class
            gsap.utils.toArray('.gsap-reveal').forEach(element => {
                gsap.fromTo(element, 
                    { opacity: 0, y: 30 },
                    { 
                        opacity: 1, 
                        y: 0, 
                        duration: 1, 
                        ease: "power3.out",
                        scrollTrigger: {
                            trigger: element,
                            start: "top 85%",
                        }
                    }
                );
            });
        });
    </script>
</body>
</html>