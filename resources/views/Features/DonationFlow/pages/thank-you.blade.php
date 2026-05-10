@extends('layouts.guest')

@section('content')

@push('styles')
<style>
    /* ========================================== */
    /* 1. GOPAY-STYLE SUCCESS ANIMATIONS          */
    /* ========================================== */
    @keyframes circlePop {
        0% { transform: scale(0); opacity: 0; }
        60% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
    @keyframes drawCheck {
        0% { stroke-dashoffset: 100; }
        100% { stroke-dashoffset: 0; }
    }
    @keyframes contentFadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    .animate-circle-pop { animation: circlePop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
    .animate-draw-check { stroke-dasharray: 100; stroke-dashoffset: 100; animation: drawCheck 0.5s ease-out 0.4s forwards; }
    .animate-fade-text { opacity: 0; animation: contentFadeIn 0.5s ease-out 0.8s forwards; }

    /* ========================================== */
    /* 2. FULL PAGE BOTTOM-TO-TOP ANIMATION       */
    /* ========================================== */
    @keyframes slideUpScreen {
        0% { transform: translateY(100vh); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    .animate-screen-up {
        /* This slides the entire container up from the bottom */
        animation: slideUpScreen 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards; 
    }
</style>
@endpush

<div id="success-loader" class="fixed inset-0 z-50 flex items-center justify-center bg-[#FAF3E7] transition-opacity duration-500">
    <div class="flex flex-col items-center">
        <div class="w-24 h-24 rounded-full bg-[#3B2415] flex items-center justify-center animate-circle-pop shadow-2xl">
            <svg class="w-12 h-12 text-white drop-shadow-md" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path class="animate-draw-check" d="M20 6L9 17l-5-5" />
            </svg>
        </div>
        <h2 class="mt-6 font-serif text-3xl font-bold text-[#4A2C11] animate-fade-text">Pembayaran Berhasil!</h2>
        <p class="mt-2 text-sm text-[#4A2C11]/70 font-medium animate-fade-text">Menyiapkan halaman...</p>
    </div>
</div>

<div id="main-content" class="relative w-full min-h-screen bg-[#FAF3E7] flex flex-col items-center justify-center py-20 z-10 overflow-hidden hidden">
    
    <div class="absolute inset-0 w-full h-full bg-top bg-no-repeat pointer-events-none z-[-1]" 
         style="background-image: url('{{ asset('donation-bg.jpg') }}'); background-size: cover;">
    </div>

    <div class="max-w-3xl mx-auto px-4 text-center relative z-10 w-full">
        
        <div class="mb-10 inline-flex items-center justify-center w-20 h-20 bg-[#D2A770]/20 rounded-full shadow-inner border border-[#D2A770]/40">
            <svg class="w-10 h-10 text-[#4A2C11]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </div>

        <h1 class="font-serif text-4xl md:text-5xl font-bold text-[#4A2C11] mb-6 leading-tight drop-shadow-sm">
            Donasi Anda<br>Telah Berhasil!
        </h1>
        
        <p class="text-[#4A2C11]/80 text-lg leading-relaxed max-w-xl mx-auto mb-14 font-medium">
            Terima kasih atas kehangatan hati Anda. Secangkir kopi Anda kini telah menjadi setumpuk buku dan senyuman di wajah anak-anak di YKIP Bali. 
        </p>
        
        <div class="mt-8 flex justify-center items-center relative z-10">
            <a href="{{ route('landing') }}" class="w-full md:w-auto px-12 py-4 rounded-full bg-[#3B2415] border-2 border-[#3B2415] text-white font-bold text-[15px] shadow-[0_8px_15px_rgba(59,36,21,0.3)] hover:scale-[1.02] hover:bg-[#2a1608] transition-all">
                Kembali ke Home
            </a>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // ==========================================
    // LOADER & ENTRANCE ANIMATION SEQUENCE
    // ==========================================
    document.addEventListener('DOMContentLoaded', () => {
        const loader = document.getElementById('success-loader');
        const mainContent = document.getElementById('main-content');

        // Let the GoPay Loader sit for 2.5 seconds
        setTimeout(() => {
            // Fade out the full-screen loader overlay
            loader.style.opacity = '0';
            
            setTimeout(() => {
                loader.style.display = 'none';
                
                // Show main content and trigger the Bottom-to-Top slide up
                mainContent.classList.remove('hidden');
                mainContent.classList.add('animate-screen-up');
                
            }, 500); // Wait 0.5s for CSS loader fade out
            
        }, 2500); 
    });
</script>
@endpush
@endsection