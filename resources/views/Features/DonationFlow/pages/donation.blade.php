@extends('layouts.guest')

@section('content')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

<div class="relative w-full overflow-x-clip">
    
    <section class="relative min-h-screen flex flex-col justify-center overflow-hidden z-10 pt-20 lg:pt-0">
        <div class="absolute inset-0 w-full h-full bg-top bg-no-repeat pointer-events-none z-[-1] bg-donation-bg">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="font-serif text-5xl md:text-6xl font-bold text-[#4A2C11] leading-tight">
                        Secangkir Kopi<br>untuk Pendidikan
                    </h1>
                    <p class="text-[#4A2C11] text-base md:text-lg leading-relaxed max-w-lg font-medium">
                        Dengan berdonasi seharga segelas kopi kekinian yang membuat harimu lebih cerah, Anda bisa menyediakan peralatan sekolah, sepatu, seragam, uang sekolah, hingga uang saku untuk anak-anak yang membutuhkan.
                    </p>
                </div>
                
                <div class="relative" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="p-2 border-2 border-[#D2A770]/30 rounded-[2.5rem]">
                        <img src="{{ asset('donation.jpg') }}" alt="Anak-anak sekolah" class="rounded-[2rem] shadow-xl w-full object-cover h-[350px] md:h-[400px]">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative w-full min-h-screen bg-[#FAF3E7] flex flex-col justify-center py-16 lg:py-24 z-10 sticky-context">
        
        <div class="absolute bottom-[-10%] left-1/2 transform -translate-x-1/2 w-[120%] md:w-[110%] h-[120%] bg-no-repeat bg-bottom bg-contain pointer-events-none z-0 opacity-10 bg-coffee-order-form">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                
                <div class="space-y-8">
                    
                    <div data-aos="fade-up" data-aos-duration="800">
                        <h2 class="font-serif text-2xl font-bold text-[#4A2C11] mb-6 text-center">Pilih jenis donasi</h2>
                        <div class="flex flex-wrap justify-center gap-4" id="tier-selector">
                            @foreach ($packages as $index => $package)
                                @php
                                    $isFirst = $index === 0;
                                    $activeClass = $isFirst 
                                        ? 'border-[#4A2C11] bg-white shadow-lg scale-105 ring-4 ring-[#D2A770]/30' 
                                        : 'border-transparent bg-[#EAE5DB] hover:bg-[#EAE5DB]/80 hover:-translate-y-1 hover:shadow-md';
                                    
                                    $label = 'CUSTOM';
                                    $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />'; 
                                    
                                    if($package->amount == 50000) {
                                        $label = 'REGULER';
                                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h10a2 2 0 012 2v2a2 2 0 01-2 2H5V8z M17 10h1a2 2 0 012 2v0a2 2 0 01-2 2h-1 M3 16h14" />';
                                    } elseif($package->amount == 75000) {
                                        $label = 'MEDIUM';
                                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4h8a2 2 0 012 2v14H6V6a2 2 0 012-2z M8 8h4 M8 12h.01" />';
                                    } elseif($package->amount == 100000) {
                                        $label = 'LARGE';
                                        $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4v5a3 3 0 01-6 0V4 m3 5v11 m8-11h-4 m2-5v16" />';
                                    }
                                @endphp

                                <button type="button" 
                                        data-amount="{{ $package->amount }}" 
                                        data-iscustom="{{ $package->is_custom ? 'true' : 'false' }}" 
                                        class="tier-btn w-[90px] h-[90px] rounded-2xl border-2 {{ $activeClass }} flex flex-col items-center justify-between py-2.5 transition-all duration-300 ease-out group active:scale-95">
                                    <svg class="w-4 h-4 text-[#4A2C11] transform transition-transform duration-300 group-hover:scale-125 group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $icon !!}
                                    </svg>
                                    <span class="font-bold text-[#4A2C11] custom-amount-display {{ $package->is_custom ? 'text-[9px] leading-tight' : 'text-[13px]' }}">
                                        {!! $package->is_custom ? 'Custom<br>Amount' : number_format($package->amount, 0, ',', '.') !!}
                                    </span>
                                    <span class="text-[8px] text-[#4A2C11]/60 font-medium tracking-wide uppercase">{{ $label }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-[#EBE3D9] pt-8 mt-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                        <h2 class="font-serif text-2xl font-bold text-[#4A2C11] mb-6 text-center">Frekuensi Donasi</h2>
                        <div class="flex flex-wrap justify-center gap-3" id="frequency-selector">
                            <button type="button" data-freq="3 Bulan" class="freq-btn px-6 py-2 rounded-full bg-[#4A2C11] text-white text-sm font-bold shadow-lg scale-105 ring-4 ring-[#D2A770]/30 transition-all duration-300 ease-out hover:-translate-y-1 active:scale-95">3 Bulan</button>
                            <button type="button" data-freq="6 Bulan" class="freq-btn px-6 py-2 rounded-full bg-[#D2A770] text-white text-sm font-bold opacity-80 hover:opacity-100 hover:-translate-y-1 hover:shadow-md transition-all duration-300 ease-out active:scale-95">6 Bulan</button>
                            <button type="button" data-freq="1 Tahun" class="freq-btn px-6 py-2 rounded-full bg-[#D2A770] text-white text-sm font-bold opacity-80 hover:opacity-100 hover:-translate-y-1 hover:shadow-md transition-all duration-300 ease-out active:scale-95">1 Tahun</button>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-[#EBE3D9] relative mt-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                        <h2 class="font-serif text-3xl font-bold text-[#4A2C11] mb-8 text-center relative z-10">Order Form</h2>
                        
                        <form action="{{ route('donation.store') }}" method="POST" id="donation-form" class="space-y-5 relative z-10">
                            @csrf
                            <input type="hidden" name="donation_tier" id="input-tier" value="{{ $packages->first()->name ?? '' }}">
                            <input type="hidden" name="amount" id="input-amount" value="{{ $packages->first()->amount ?? 0 }}">
                            <input type="hidden" name="frequency" id="input-frequency" value="3 Bulan">
                            
                            <div class="space-y-1.5">
                                <label class="block text-sm font-bold text-[#4A2C11] ml-4">Nama Lengkap</label>
                                <input type="text" name="name" required placeholder="Masukkan Nama Lengkap Anda" 
                                    class="w-full bg-white/60 backdrop-blur-sm border border-[#C99856]/60 rounded-full focus:border-[#4A2C11] focus:ring-1 focus:ring-[#4A2C11] px-5 py-3 text-sm text-[#4A2C11] placeholder-[#C99856]/60 transition-all shadow-sm">
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-bold text-[#4A2C11] ml-4">Alamat E-Mail</label>
                                    <input type="email" name="email" required placeholder="contoh@email.com" 
                                        class="w-full bg-white/60 backdrop-blur-sm border border-[#C99856]/60 rounded-full focus:border-[#4A2C11] focus:ring-1 focus:ring-[#4A2C11] px-5 py-3 text-sm text-[#4A2C11] placeholder-[#C99856]/60 transition-all shadow-sm">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-bold text-[#4A2C11] ml-4">No Telp (Opsional)</label>
                                    <input type="tel" name="phone" placeholder="08xxxxxxxxxx" 
                                        class="w-full bg-white/60 backdrop-blur-sm border border-[#C99856]/60 rounded-full focus:border-[#4A2C11] focus:ring-1 focus:ring-[#4A2C11] px-5 py-3 text-sm text-[#4A2C11] placeholder-[#C99856]/60 transition-all shadow-sm">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-bold text-[#4A2C11] ml-4">Jenis Kelamin</label>
                                    <select name="gender" required
                                            class="w-full bg-white/60 backdrop-blur-sm border border-[#C99856]/60 rounded-full focus:border-[#4A2C11] focus:ring-1 focus:ring-[#4A2C11] px-5 py-3 text-sm text-[#4A2C11] transition-all appearance-none shadow-sm">
                                        <option value="" disabled selected class="text-[#C99856]/60">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" class="text-gray-900">Laki-laki</option>
                                        <option value="Perempuan" class="text-gray-900">Perempuan</option>
                                    </select>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-sm font-bold text-[#4A2C11] ml-4">Pekerjaan</label>
                                    <input type="text" name="occupation" required placeholder="Pekerjaan Anda saat ini" 
                                        class="w-full bg-white/60 backdrop-blur-sm border border-[#C99856]/60 rounded-full focus:border-[#4A2C11] focus:ring-1 focus:ring-[#4A2C11] px-5 py-3 text-sm text-[#4A2C11] placeholder-[#C99856]/60 transition-all shadow-sm">
                                </div>
                            </div>

                            <div class="pt-6 relative z-20">
                                <button type="submit" id="submit-form-btn" class="mx-auto flex py-3.5 px-12 rounded-full bg-[#3B2415] text-white font-bold text-[15px] shadow-[0_8px_15px_rgba(59,36,21,0.3)] hover:scale-[1.02] transition-transform justify-center items-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Lanjut Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:pl-8 sticky top-28 z-10 self-start" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                    <div class="bg-[#FDFBF7] rounded-[3rem] p-8 md:p-10 shadow-2xl border border-[#EBE3D9] flex flex-col items-center text-center relative z-10">
                        <div id="impact-illustration" class="h-40 w-40 mb-6 flex items-center justify-center text-[5.5rem] drop-shadow-xl transition-all duration-500 ease-in-out transform hover:scale-105">
                            👟
                        </div>
                        <p id="impact-text" class="text-[#4A2C11] font-bold text-lg md:text-xl leading-relaxed max-w-sm transition-opacity duration-300">
                            Satu pasang sepatu dan kaus kaki sekolah
                        </p>
                        
                        <div class="mt-8 pt-6 border-t border-[#D2A770]/40 w-full text-left space-y-3 receipt-breakdown">
                            <h3 class="text-xs tracking-wider uppercase font-bold text-[#4A2C11]/60 mb-2 text-center">Rincian Donasi</h3>
                            <div class="flex justify-between items-center text-sm font-medium">
                                <span class="text-[#4A2C11]/80">Pilihan Nominal</span>
                                <span id="display-amount" class="text-[#4A2C11]">Rp 50.000 <span class="text-xs text-[#4A2C11]/60">/bln</span></span>
                            </div>
                            <div class="flex justify-between items-center text-sm font-medium">
                                <span class="text-[#4A2C11]/80">Durasi Bantuan</span>
                                <span id="display-freq" class="text-[#4A2C11]">3 Bulan</span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-dashed border-[#D2A770]/60 mt-3">
                                <span class="font-serif italic text-[#C99856] text-lg">Total Donasi</span>
                                <span id="display-total" class="text-2xl font-bold text-[#4A2C11]">Rp 150.000</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>

<div id="custom-amount-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-[#3E2723]/40 backdrop-blur-sm transition-opacity duration-500 opacity-0">
    <div id="modal-panel" class="bg-[#FDFBF7] rounded-[2rem] p-8 max-w-sm w-full mx-4 shadow-2xl border border-[#EBE3D9] relative opacity-0">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-[#EAE5DB] rounded-full flex items-center justify-center mx-auto mb-4 text-[#4A2C11]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
            </div>
            <h3 class="font-serif text-2xl font-bold text-[#4A2C11]">Custom Amount</h3>
            <p class="text-sm text-[#4A2C11]/70 mt-2">Masukkan nominal donasi yang Anda inginkan (Minimal Rp 10.000)</p>
        </div>
        <div class="space-y-4">
            <div class="relative">
                <span class="absolute left-5 top-1/2 -translate-y-1/2 font-bold text-[#4A2C11]">Rp</span>
                <input type="number" id="custom-amount-input" class="w-full bg-white border border-[#C99856]/60 rounded-full focus:border-[#4A2C11] focus:ring-1 focus:ring-[#4A2C11] pl-12 pr-5 py-3.5 text-lg font-bold text-[#4A2C11] shadow-sm outline-none" placeholder="150000">
            </div>
            <p id="custom-error-msg" class="text-red-500 text-xs text-center hidden font-medium">Nominal tidak valid. Minimal Rp 10.000.</p>
            <div class="flex gap-3 pt-4">
                <button type="button" id="custom-cancel-btn" class="flex-1 py-3 rounded-full border border-[#C99856] text-[#4A2C11] font-bold hover:bg-[#EAE5DB] transition-colors">Batal</button>
                <button type="button" id="custom-confirm-btn" class="flex-1 py-3 rounded-full bg-[#3B2415] text-white font-bold shadow-md hover:bg-[#2a1608] transition-colors">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

<div id="confirm-payment-modal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-[#3E2723]/60 backdrop-blur-sm transition-opacity duration-500 opacity-0">
    <div id="confirm-modal-panel" class="bg-[#FDFBF7] rounded-[2rem] p-8 max-w-sm w-full mx-4 shadow-2xl border border-[#EBE3D9] relative opacity-0">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-[#EAE5DB] rounded-full flex items-center justify-center mx-auto mb-4 text-[#4A2C11]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <h3 class="font-serif text-2xl font-bold text-[#4A2C11]">Konfirmasi Donasi</h3>
            <p class="text-sm text-[#4A2C11]/80 mt-3 font-medium leading-relaxed">Pastikan data dan rincian donasi Anda sudah benar. Anda akan diarahkan ke halaman pembayaran.</p>
        </div>
        
        <div class="flex gap-3 pt-4">
            <button type="button" id="cancel-payment-btn" class="flex-1 py-3 rounded-full border border-[#C99856] text-[#4A2C11] font-bold hover:bg-[#EAE5DB] transition-colors">Periksa Lagi</button>
            <button type="button" id="confirm-payment-btn" class="flex-1 flex justify-center items-center py-3 rounded-full bg-[#3B2415] text-white font-bold shadow-md hover:bg-[#2a1608] transition-colors">
                <span>Ya, Lanjut</span>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize AOS animations
        AOS.init({ once: true, offset: 50 });

        const tierBtns = document.querySelectorAll('.tier-btn');
        const freqBtns = document.querySelectorAll('.freq-btn');
        const inputTier = document.getElementById('input-tier');
        const inputAmount = document.getElementById('input-amount');
        const inputFreq = document.getElementById('input-frequency');
        
        const impactText = document.getElementById('impact-text');
        const impactIllustration = document.getElementById('impact-illustration');
        const displayAmount = document.getElementById('display-amount');
        const displayFreq = document.getElementById('display-freq');
        const displayTotal = document.getElementById('display-total');

        const donationForm = document.getElementById('donation-form');
        const confirmModal = document.getElementById('confirm-payment-modal');
        const confirmModalPanel = document.getElementById('confirm-modal-panel');
        const cancelPaymentBtn = document.getElementById('cancel-payment-btn');
        const confirmPaymentBtn = document.getElementById('confirm-payment-btn');

        const customModal = document.getElementById('custom-amount-modal');
        const modalPanel = document.getElementById('modal-panel');
        const customInput = document.getElementById('custom-amount-input');
        const customCancel = document.getElementById('custom-cancel-btn');
        const customConfirm = document.getElementById('custom-confirm-btn');
        const customError = document.getElementById('custom-error-msg');

        let currentAmount = '{{ $packages->first()->amount ?? 50000 }}';
        let currentFreq = '3 Bulan';
        let pendingCustomBtn = null;

        const impactMatrix = {
            '50000': {
                '3 Bulan': { text: 'Satu pasang sepatu dan kaus kaki sekolah', icon: '👟' },
                '6 Bulan': { text: 'Satu pasang Sepatu dan kaus kaki, satu buah tas sekolah', icon: '🎒' },
                '1 Tahun': { text: 'Uang sekolah untuk anak SMP untuk satu semester', icon: '🏫' }
            },
            '75000': {
                '3 Bulan': { text: 'Pembayaran uang extra kurikuler untuk setahun', icon: '🎨' },
                '6 Bulan': { text: 'Seragam sekolah, Sepatu, dan kaus kaki untuk 1 anak SMA', icon: '👔' },
                '1 Tahun': { text: 'Uang sekolah untuk anak SMA/SMK untuk satu semester', icon: '🎓' }
            },
            '100000': {
                '3 Bulan': { text: 'Pembayaran LKS untuk satu semester', icon: '📚' },
                '6 Bulan': { text: 'Paket perlengkapan sekolah (buku, pulpen, pensil, dll)', icon: '✏️' },
                '1 Tahun': { text: 'Uang sekolah untuk anak SMA/SMK untuk satu semester dan pembelian buku LKS', icon: '📖' }
            }
        };

        const defaultImpact = { 
            text: 'Kebaikan tanpa batas. Setiap rupiah yang Anda berikan membawa harapan baru bagi pendidikan anak-anak di Bali. Terima kasih!', 
            icon: '❤️' 
        };

        function calculateTotal(amount, freqStr) {
            let months = 1;
            if(freqStr.includes('3')) months = 3;
            else if(freqStr.includes('6')) months = 6;
            else if(freqStr.includes('1 Tahun')) months = 12;
            return parseInt(amount) * months;
        }

        const currencyFormatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

        function updateImpactCard() {
            impactText.style.opacity = 0;
            impactIllustration.style.transform = 'scale(0.8)';
            impactIllustration.style.opacity = 0;

            setTimeout(() => {
                let impactData = defaultImpact;
                if(impactMatrix[currentAmount] && impactMatrix[currentAmount][currentFreq]) {
                    impactData = impactMatrix[currentAmount][currentFreq];
                }

                impactText.textContent = impactData.text;
                impactIllustration.textContent = impactData.icon;
                
                displayAmount.innerHTML = currencyFormatter.format(currentAmount) + ' <span class="text-xs text-[#4A2C11]/60">/bln</span>';
                displayFreq.textContent = currentFreq;
                displayTotal.textContent = currencyFormatter.format(calculateTotal(currentAmount, currentFreq));

                impactText.style.opacity = 1;
                impactIllustration.style.transform = 'scale(1)';
                impactIllustration.style.opacity = 1;
            }, 200);
        }

        function setActiveTierBtn(activeBtn) {
            tierBtns.forEach(b => {
                b.classList.remove('border-[#4A2C11]', 'bg-white', 'shadow-lg', 'scale-105', 'ring-4', 'ring-[#D2A770]/30');
                b.classList.add('border-transparent', 'bg-[#EAE5DB]', 'hover:bg-[#EAE5DB]/80', 'hover:-translate-y-1', 'hover:shadow-md');
            });
            activeBtn.classList.remove('border-transparent', 'bg-[#EAE5DB]', 'hover:bg-[#EAE5DB]/80', 'hover:-translate-y-1', 'hover:shadow-md');
            activeBtn.classList.add('border-[#4A2C11]', 'bg-white', 'shadow-lg', 'scale-105', 'ring-4', 'ring-[#D2A770]/30');
        }

        function openCustomModal() {
            customModal.classList.remove('hidden');
            customModal.classList.add('flex');
            requestAnimationFrame(() => {
                customModal.classList.remove('opacity-0');
                customModal.classList.add('opacity-100');
                modalPanel.classList.remove('opacity-0', 'modal-animate-out');
                modalPanel.classList.add('modal-animate-in');
            });
            customInput.value = '';
            customInput.focus();
        }

        function closeCustomModal() {
            modalPanel.classList.remove('modal-animate-in');
            modalPanel.classList.add('modal-animate-out');
            customModal.classList.remove('opacity-100');
            customModal.classList.add('opacity-0');
            customError.classList.add('hidden');
            setTimeout(() => {
                customModal.classList.add('hidden');
                customModal.classList.remove('flex');
                modalPanel.classList.add('opacity-0');
            }, 400); 
        }

        tierBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.dataset.iscustom === 'true') {
                    pendingCustomBtn = btn;
                    openCustomModal();
                } else {
                    setActiveTierBtn(btn);
                    currentAmount = btn.dataset.amount;
                    inputAmount.value = currentAmount;
                    updateImpactCard();
                }
            });
        });

        customCancel.addEventListener('click', closeCustomModal);
        customModal.addEventListener('click', (e) => { if (e.target === customModal) closeCustomModal(); });

        customConfirm.addEventListener('click', () => {
            const val = parseInt(customInput.value);
            if (isNaN(val) || val < 10000) {
                customError.classList.remove('hidden');
                return;
            }
            currentAmount = val.toString();
            inputAmount.value = currentAmount;
            
            const customTextSpan = pendingCustomBtn.querySelector('.custom-amount-display');
            customTextSpan.innerHTML = new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(val);
            customTextSpan.classList.remove('text-[9px]', 'leading-tight');
            customTextSpan.classList.add('text-[13px]');

            setActiveTierBtn(pendingCustomBtn);
            updateImpactCard();
            closeCustomModal();
        });

        freqBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                freqBtns.forEach(b => {
                    b.classList.remove('bg-[#4A2C11]', 'opacity-100', 'shadow-lg', 'scale-105', 'ring-4', 'ring-[#D2A770]/30');
                    b.classList.add('bg-[#D2A770]', 'opacity-80', 'hover:-translate-y-1', 'hover:shadow-md');
                });
                btn.classList.remove('bg-[#D2A770]', 'opacity-80', 'hover:-translate-y-1', 'hover:shadow-md');
                btn.classList.add('bg-[#4A2C11]', 'opacity-100', 'shadow-lg', 'scale-105', 'ring-4', 'ring-[#D2A770]/30');
                
                currentFreq = btn.dataset.freq;
                inputFreq.value = currentFreq;
                updateImpactCard();
            });
        });

        function openConfirmModal() {
            confirmModal.classList.remove('hidden');
            confirmModal.classList.add('flex');
            requestAnimationFrame(() => {
                confirmModal.classList.remove('opacity-0');
                confirmModal.classList.add('opacity-100');
                confirmModalPanel.classList.remove('opacity-0', 'modal-animate-out');
                confirmModalPanel.classList.add('modal-animate-in');
            });
        }

        function closeConfirmModal() {
            confirmModalPanel.classList.remove('modal-animate-in');
            confirmModalPanel.classList.add('modal-animate-out');
            confirmModal.classList.remove('opacity-100');
            confirmModal.classList.add('opacity-0');
            setTimeout(() => {
                confirmModal.classList.add('hidden');
                confirmModal.classList.remove('flex');
                confirmModalPanel.classList.add('opacity-0');
            }, 400); 
        }

        donationForm.addEventListener('submit', (e) => {
            e.preventDefault(); 
            openConfirmModal();
        });

        cancelPaymentBtn.addEventListener('click', closeConfirmModal);
        confirmModal.addEventListener('click', (e) => { if (e.target === confirmModal) closeConfirmModal(); });

        confirmPaymentBtn.addEventListener('click', () => {
            confirmPaymentBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span class="ml-2">Memproses...</span>';
            confirmPaymentBtn.disabled = true;
            
            HTMLFormElement.prototype.submit.call(donationForm);
        });

        updateImpactCard();
    });
</script>
@endpush
@endsection