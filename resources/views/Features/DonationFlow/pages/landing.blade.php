@extends('layouts.guest')

@section('content')

<div class="relative w-full">

    <div class="absolute inset-x-0 top-0 w-full h-full bg-top bg-no-repeat pointer-events-none z-[-1] bg-landing-top">
    </div>

    <section class="relative min-h-[calc(100vh-80px)] flex flex-col justify-center py-12 z-10">
        <div class="max-w-5xl mx-auto px-4 flex flex-col items-center w-full">
            
            <h1 class="font-serif text-3xl md:text-[3.5rem] font-bold text-[#4A2C11] tracking-wider uppercase z-10 text-center -mb-4 md:-mb-5 drop-shadow-sm leading-tight">
                Secangkir Kopi,
            </h1>

            <div class="relative w-full mt-4 md:mt-6">
                
                <h2 class="absolute top-5 md:top-4 left-0 right-0 text-center font-serif text-3xl md:text-[3.5rem] font-bold text-white tracking-wider uppercase z-20 drop-shadow-[0_4px_6px_rgba(0,0,0,0.8)] leading-tight">
                    Sebuah Harapan
                </h2>

                <div class="relative w-full h-[400px] md:h-[550px] rounded-[2.5rem] md:rounded-[3rem] border-[6px] md:border-[8px] border-[#D2A770]/40 shadow-2xl overflow-hidden">
                    <img src="{{ asset('landing-hero-1.jpg') }}" alt="Anak-anak sekolah" class="w-full h-full object-cover" />
                    <div class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-[#2a1608]/80 via-[#2a1608]/40 to-transparent pointer-events-none"></div>
                </div>
                
                <div class="absolute -bottom-7 md:-bottom-8 left-1/2 transform -translate-x-1/2 w-full max-w-[280px] md:max-w-[340px] z-30">
                    <a href="{{ route('donation.form') }}" class="block w-full py-4 rounded-full bg-gradient-to-b from-[#E6B97A] to-[#C99856] text-white font-bold text-lg md:text-xl shadow-[0_10px_20px_rgba(201,152,86,0.4)] hover:shadow-[0_15px_25px_rgba(201,152,86,0.6)] hover:brightness-105 transition-all text-center border-4 border-white/30">
                        Donasi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="relative min-h-screen flex flex-col justify-center py-12 z-10">
        <div class="max-w-5xl mx-auto px-4 w-full">
            <div class="relative bg-[#FCF9F5] rounded-[3rem] p-8 md:p-16 shadow-lg border border-[#EBE3D9] flex flex-col md:flex-row gap-12 items-center text-left">
                
                <div class="w-full md:w-1/2 space-y-6 z-10 pr-0 md:pr-4">
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#4A2C11]">Tentang Kami</h2>
                    <p class="text-[#4A2C11] leading-relaxed text-sm md:text-[15px] font-medium text-justify">
                        Didirikan pada 2002 sebagai respons terhadap Bom Bali I, Yayasan Kemanusiaan Ibu Pertiwi (YKIP) berfokus pada peningkatan akses pendidikan bagi anak-anak kurang mampu. Melalui berbagai program beasiswa dari tingkat SD hingga perguruan tinggi, YKIP kini menjangkau siswa di lima kabupaten dan satu kota di Bali, dengan tujuan meningkatkan kualitas hidup melalui pendidikan.
                    </p>
                    
                    <a href="https://ykip.org/id/" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="inline-block text-[14px] text-[#C99856] mt-10 font-serif italic underline underline-offset-4 hover:text-[#a87b40] transition-colors">
                        Yayasan Kemanusiaan Ibu Pertiwi
                    </a>
                </div>
                
                <div class="w-full md:w-1/2 z-10 relative">
                    <div class="p-2 border-2 border-[#D2A770]/30 rounded-[2.5rem]">
                        <img src="{{ asset('tentang.jpg') }}" 
                             alt="Tentang YKIP" 
                             class="rounded-[2rem] shadow-sm w-full object-cover h-64 md:h-[380px]">
                    </div>
                </div>

                <img src="{{ asset('tentang-kami-coffee.png') }}" 
                     alt="Coffee Cup Graphic" 
                     class="absolute -bottom-10 -right-6 w-32 h-32 drop-shadow-2xl md:-bottom-16 md:-right-12 md:w-52 md:h-52 z-20">
            </div>
        </div>
    </section>

</div>


<section id="about" class="relative min-h-screen flex flex-col justify-center py-12 pb-32">    
    
    <div class="absolute inset-x-0 bottom-0 w-full h-[70%] bg-bottom bg-no-repeat pointer-events-none z-[-1] bg-bottom-cups">
    </div>

    <div class="max-w-4xl mx-auto px-4 text-center space-y-8 w-full relative z-10">
        
        <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#4A2C11] leading-snug tracking-wider uppercase">
            MENGAPA DONASI<br>SEHARGA KOPI?
        </h2>
        
        <div class="space-y-6 text-[#4A2C11] font-bold px-4 md:px-12 text-sm md:text-base leading-relaxed">
            <p>Tahukah Anda bahwa dengan berdonasi seharga secangkir kopi kekinian yang<br class="hidden md:block"> dinikmati sehari-hari bisa memberikan dampak besar pada Pendidikan anak-<br class="hidden md:block">anak yang membutuhkan?</p>
            
            <p>Dengan menyisihkan uang seharga satu cangkir kopi kekinian tiap bulannya dan<br class="hidden md:block"> mendonasikannya pada program beasiswa YKIP, Anda sudah bisa membantu<br class="hidden md:block"> anak-anak di Bali untuk mendapatkan pendidikan yang layak.</p>
            
            <p>Donasi seharga kopi bisa menyelamatkan seorang anak dari putus sekolah. Yuk<br class="hidden md:block"> donasi sekarang dengan klik tombol di bawah ini.</p>
        </div>
        
        <div class="pt-8 relative z-20">
            <a href="{{ route('donation.form') }}" class="inline-block px-20 py-4 rounded-full bg-gradient-to-b from-[#4A2C11] to-[#2a1608] text-white font-bold text-lg hover:scale-[1.02] transition-all duration-300 shadow-[0_8px_15px_rgba(74,44,17,0.4)] border border-[#5c3a1a]">
                Donasi Sekarang
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        AOS.init({ once: true, offset: 50, duration: 800 });
    });
</script>
@endpush

@endsection