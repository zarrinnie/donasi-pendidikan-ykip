@extends('layouts.landing')

@section('content')
    <section class="relative w-full h-[80vh] min-h-[600px] flex items-center">
        <div class="absolute inset-0 bg-gray-600 bg-center bg-cover bg-welcome-hero">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-16 flex flex-col items-end">
            <h1 class="text-4xl lg:text-6xl font-bold text-white text-right max-w-2xl leading-tight mb-12 gsap-reveal">
                Spare your change,<br>
                Save the Children
            </h1>

            <div class="bg-[#8C6239]/90 backdrop-blur-sm p-8 rounded-lg max-w-md text-white text-center shadow-xl gsap-reveal">
                <h3 class="text-xl font-bold text-[#F4B41A] mb-3">Make Donation</h3>
                <p class="text-sm mb-6 leading-relaxed">
                    Setiap donasi yang Anda berikan sangat berarti bagi anak-anak yang membutuhkan pendidikan, demi masa depan yang lebih baik.
                </p>
                <a href="#" class="inline-block bg-[#F4B41A] text-gray-900 px-8 py-3 rounded-full font-bold hover:bg-yellow-500 transition shadow-lg">
                    Donate Now
                </a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <div class="text-[#8C6239] text-5xl mb-4 flex justify-center gsap-reveal">𓅰</div>
            <h2 class="text-3xl font-bold mb-16 gsap-reveal">Tentang YKIP</h2>

            <div class="grid lg:grid-cols-2 gap-0 lg:gap-8 items-center">
                <div class="bg-[#FDF4E6] p-10 lg:p-16 text-left rounded-lg lg:rounded-none h-full flex flex-col justify-center gsap-reveal">
                    <p class="leading-relaxed text-gray-700">
                        Didirikan pada 2002 sebagai respons terhadap Bom Bali I, Yayasan Kemanusiaan Ibu Pertiwi (YKIP) berfokus pada peningkatan akses pendidikan bagi anak-anak kurang mampu. Melalui berbagai program beasiswa dari tingkat SD hingga perguruan tinggi, YKIP kini menjangkau siswa di lima kabupaten dan satu kota di Bali, dengan tujuan meningkatkan kualitas hidup melalui pendidikan.
                    </p>
                </div>
                <div class="h-64 lg:h-full w-full min-h-[300px] bg-gray-300 rounded-lg lg:rounded-none bg-cover bg-center gsap-reveal bg-welcome-about">
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-6">
            <p class="text-center text-sm tracking-widest text-gray-400 mb-4 uppercase gsap-reveal">Program YKIP</p>
            <h2 class="text-2xl lg:text-3xl font-bold text-center mb-12 text-[#1b1b18] gsap-reveal">
                Sejak tahun 2002, YKIP menjalankan program sebagai berikut:
            </h2>

            <div class="space-y-6">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center py-6 border-b border-gray-200 gsap-reveal">
                    <div class="max-w-2xl mb-4 lg:mb-0">
                        <h4 class="font-bold text-lg mb-2">KIDS Scholarship Program</h4>
                        <p class="text-sm text-gray-600">Dukungan pendidikan untuk anak-anak tingkat SD dan SMP, memastikan mereka memiliki akses ke pendidikan dasar yang layak.</p>
                    </div>
                    <a href="#" class="bg-[#F4B41A] text-gray-900 px-6 py-2 rounded-full text-sm font-bold hover:bg-yellow-500 transition shrink-0">Learn more</a>
                </div>

                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center py-6 border-b border-gray-200 gsap-reveal">
                    <div class="max-w-2xl mb-4 lg:mb-0">
                        <h4 class="font-bold text-lg mb-2">Kembali Scholarship Program</h4>
                        <p class="text-sm text-gray-600">Beasiswa yang dirancang untuk mendukung kelanjutan studi siswa SMA/SMK guna mencegah putus sekolah.</p>
                    </div>
                    <a href="#" class="bg-[#F4B41A] text-gray-900 px-6 py-2 rounded-full text-sm font-bold hover:bg-yellow-500 transition shrink-0">Learn more</a>
                </div>

                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center py-6 border-b border-gray-200 gsap-reveal">
                    <div class="max-w-2xl mb-4 lg:mb-0">
                        <h4 class="font-bold text-lg mb-2">Vocational Scholarship Program</h4>
                        <p class="text-sm text-gray-600">Program pelatihan vokasi singkat (1-2 tahun) untuk membekali lulusan SMA dengan keterampilan kerja praktis.</p>
                    </div>
                    <a href="#" class="bg-[#F4B41A] text-gray-900 px-6 py-2 rounded-full text-sm font-bold hover:bg-yellow-500 transition shrink-0">Learn more</a>
                </div>

                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center py-6 border-b border-gray-200 gsap-reveal">
                    <div class="max-w-2xl mb-4 lg:mb-0">
                        <h4 class="font-bold text-lg mb-2">University Scholarship Program</h4>
                        <p class="text-sm text-gray-600">Dukungan penuh bagi siswa berprestasi untuk meraih gelar Sarjana (S1), menutupi biaya kuliah dan tunjangan hidup.</p>
                    </div>
                    <a href="#" class="bg-[#F4B41A] text-gray-900 px-6 py-2 rounded-full text-sm font-bold hover:bg-yellow-500 transition shrink-0">Learn more</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-center text-lg tracking-[0.2em] font-bold text-gray-800 mb-12 uppercase gsap-reveal">Recent News</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <a href="#" class="group block overflow-hidden rounded-sm gsap-reveal">
                    <div class="h-64 lg:h-80 w-full bg-gray-300 bg-cover bg-center transition duration-500 group-hover:scale-105 bg-welcome-news-1"></div>
                </a>
                
                <a href="#" class="group block overflow-hidden rounded-sm gsap-reveal">
                    <div class="h-64 lg:h-80 w-full bg-gray-300 bg-cover bg-center transition duration-500 group-hover:scale-105 bg-welcome-news-2"></div>
                </a>
            </div>
        </div>
    </section>
@endsection