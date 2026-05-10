@extends('layouts.guest')

@section('content')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Elegant Center Pop Animation for the Modal */
    @keyframes elegantPopIn {
        0% { opacity: 0; transform: scale(0.9) translateY(20px); }
        100% { opacity: 1; transform: scale(1) translateY(0); }
    }
    @keyframes elegantPopOut {
        0% { opacity: 1; transform: scale(1) translateY(0); }
        100% { opacity: 0; transform: scale(0.95) translateY(10px); }
    }
    
    .modal-pop-in { animation: elegantPopIn 0.5s cubic-bezier(0.23, 1, 0.32, 1) forwards; }
    .modal-pop-out { animation: elegantPopOut 0.4s cubic-bezier(0.23, 1, 0.32, 1) forwards; }
</style>
@endpush

<div class="min-h-screen bg-[#EBE3D9] py-16 relative overflow-hidden flex items-center justify-center"
     style="background-image: url('{{ asset('payment-pattern.png') }}'); background-size: cover; background-position: center; background-blend-mode: multiply;">
    
    <div class="max-w-5xl w-full mx-auto px-4 flex flex-col md:flex-row items-center md:items-stretch justify-center gap-10 md:gap-14 relative z-10">
        
        <div data-aos="fade-right" data-aos-duration="1000" class="w-full md:w-[400px] bg-[#FAF6F0] p-4 rounded-[1.5rem] shadow-2xl relative z-10 flex flex-col justify-center">
            <div class="bg-white w-full rounded-sm border border-gray-200 overflow-hidden shadow-sm flex items-center justify-center h-full">
                <img src="{{ asset('qris.jpeg') }}" alt="QRIS Poster" class="w-full h-auto object-contain">
            </div>
        </div>

        <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200" class="w-full md:w-[420px] bg-[#FAF6F0] rounded-[1.5rem] shadow-2xl relative z-10 p-8 md:p-10 flex flex-col min-h-[550px]">
            
            <div class="absolute inset-4 z-0 pointer-events-none">
                <img src="{{ asset('payment-border.png') }}" alt="Border" class="w-full h-full object-fill opacity-90">
            </div>

            <img src="{{ asset('payment-top-left.png') }}" alt="Beans Left" class="absolute -left-12 bottom-[180px] w-24 drop-shadow-md z-30 pointer-events-none">
            <img src="{{ asset('payment-top-right.png') }}" alt="Beans Right" class="absolute -right-10 bottom-[110px] w-20 drop-shadow-md z-30 pointer-events-none">
            <img src="{{ asset('payment-bottom-right.png') }}" alt="Beans" class="absolute -right-[15px] bottom-[5px] w-[130px] drop-shadow-md z-30 pointer-events-none">
            <img src="{{ asset('payment-bottom-left.png') }}" alt="Cup" class="absolute -left-[80px] -bottom-[30px] w-[160px] drop-shadow-xl z-30 pointer-events-none">

            <div class="relative z-20 flex flex-col h-full px-5 md:px-7 pt-4">
                
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-serif text-2xl font-bold text-[#4A2C11]">Detail Pembayaran</h2>
                    <div class="bg-[#EBE3D9] p-2 rounded-lg text-[#4A2C11] shadow-sm border border-[#D2A770]/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                
                <div class="space-y-6 text-[14px]">
                    <div class="flex justify-between items-center">
                        <span class="text-[#4A2C11]/80 font-medium">Donasi</span>
                        <span class="font-bold text-[#4A2C11] uppercase">{{ $donation->donation_tier }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#4A2C11]/80 font-medium">Frekuensi Donasi</span>
                        <span class="font-bold text-[#4A2C11] uppercase">{{ $donation->frequency }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#4A2C11]/80 font-medium">Harga</span>
                        <span class="font-bold text-[#4A2C11] uppercase">RP. {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="mt-auto pt-6">
                    <div class="flex justify-between items-end mb-8">
                        <span class="font-bold text-[#4A2C11] text-lg">Today's Total</span>
                        <div class="text-right">
                            <span class="block text-[11px] text-[#4A2C11]/80 font-medium mb-1">{{ $donation->donation_tier }} Cup</span>
                            <span class="block font-bold text-[20px] text-[#4A2C11] leading-none">Rp. {{ number_format($donation->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <button type="button" id="trigger-confirm-modal" class="w-full flex justify-center items-center gap-2 py-3.5 rounded-xl bg-[#3B2415] text-white font-bold text-sm shadow-[0_8px_15px_rgba(59,36,21,0.3)] hover:bg-[#2A190E] hover:scale-[1.02] transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Selesai Pembayaran
                    </button>
                    
                    <p class="text-[9px] text-center text-[#4A2C11]/70 mt-6 mb-6 leading-relaxed font-medium max-w-[280px] mx-auto">
                        Sebagaimana secangkir kopi Anda membuat hari menjadi jauh lebih baik dan menyenangkan, donasi seharga kopi ini juga membawa masa depan yang lebih baik bagi anak-anak yang memerlukan.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="qris-confirm-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-[#3E2723]/60 backdrop-blur-sm transition-opacity duration-500 opacity-0">
    <div id="qris-modal-panel" class="bg-[#FDFBF7] rounded-[2rem] p-8 max-w-sm w-full mx-4 shadow-2xl border border-[#EBE3D9] relative opacity-0">
        
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-[#EAE5DB] rounded-full flex items-center justify-center mx-auto mb-4 text-[#4A2C11]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
            </div>
            <h3 class="font-serif text-2xl font-bold text-[#4A2C11]">Konfirmasi Pembayaran</h3>
            <p class="text-sm text-[#4A2C11]/80 mt-3 font-medium leading-relaxed">
                Apakah Anda sudah melakukan scan QRIS dan menyelesaikan pembayaran di aplikasi e-wallet / m-banking Anda?
            </p>
        </div>
        
        <div class="flex gap-3 pt-4">
            <button type="button" id="btn-cancel-qris" class="flex-1 py-3 rounded-full border border-[#C99856] text-[#4A2C11] font-bold hover:bg-[#EAE5DB] transition-colors">Belum</button>
            <button type="button" id="btn-confirm-qris" class="flex-1 flex justify-center items-center py-3 rounded-full bg-[#3B2415] text-white font-bold shadow-md hover:bg-[#2A190E] transition-colors">
                <span>Ya, Sudah</span>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize AOS animations
        AOS.init({
            once: true,
            offset: 50,
        });

        // Modal Elements
        const modal = document.getElementById('qris-confirm-modal');
        const modalPanel = document.getElementById('qris-modal-panel');
        const btnOpen = document.getElementById('trigger-confirm-modal');
        const btnCancel = document.getElementById('btn-cancel-qris');
        const btnConfirm = document.getElementById('btn-confirm-qris');

        // Open Modal Function
        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Request animation frame ensures display:flex applies before we toggle opacity
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                modalPanel.classList.remove('opacity-0', 'modal-pop-out');
                modalPanel.classList.add('modal-pop-in');
            });
        }

        // Close Modal Function
        function closeModal() {
            modalPanel.classList.remove('modal-pop-in');
            modalPanel.classList.add('modal-pop-out');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 400); // Matches CSS animation duration
        }

        // Event Listeners
        btnOpen.addEventListener('click', openModal);
        btnCancel.addEventListener('click', closeModal);
        
        // Close modal if user clicks outside the panel (on the dark background)
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Confirm Button - Redirects to Receipt
        btnConfirm.addEventListener('click', () => {
            // Give visual feedback that it's loading
            btnConfirm.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Memproses...
            `;
            btnConfirm.disabled = true;

            // Redirect to the success/receipt page
            window.location.href = "{{ route('donation.receipt', $donation->id) }}";
        });
    });
</script>
@endpush
@endsection