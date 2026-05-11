@extends('layouts.guest')

@section('content')

@push('styles')

@endpush

<div id="success-loader" class="fixed inset-0 z-50 flex items-center justify-center bg-[#FAF3E7] transition-opacity duration-500">
    <div class="flex flex-col items-center">
        <div class="w-24 h-24 rounded-full bg-[#3B2415] flex items-center justify-center animate-circle-pop shadow-2xl">
            <svg class="w-12 h-12 text-white drop-shadow-md" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path class="animate-draw-check" d="M20 6L9 17l-5-5" />
            </svg>
        </div>
        <h2 class="mt-6 font-serif text-3xl font-bold text-[#4A2C11] animate-fade-text">Pembayaran Berhasil!</h2>
        <p class="mt-2 text-sm text-[#4A2C11]/70 font-medium animate-fade-text">Mencetak resi donasi...</p>
    </div>
</div>

<div id="main-content" class="relative w-full min-h-screen bg-[#FAF3E7] flex flex-col items-center justify-center py-20 z-10 overflow-hidden hidden">
    
    <div class="absolute inset-0 w-full h-full bg-top bg-no-repeat pointer-events-none z-[-1] bg-donation-bg">
    </div>

    <div class="max-w-3xl mx-auto px-4 text-center relative z-10 w-full">
        
        <h1 class="font-serif text-4xl md:text-5xl font-bold text-[#4A2C11] mb-6 leading-tight drop-shadow-sm">
            Donasi Anda<br>Telah Berhasil!
        </h1>
        
        <p class="text-[#4A2C11]/80 leading-relaxed max-w-xl mx-auto mb-14 font-medium">
            Terima kasih atas kehangatan hati Anda. Secangkir kopi Anda kini telah menjadi setumpuk buku dan senyuman di wajah anak-anak di YKIP Bali. 
        </p>
        
        <div id="receipt-card" class="relative w-full max-w-sm mx-auto shadow-[0_20px_50px_rgba(74,44,17,0.15)] z-20">
            
            <div class="receipt-edge-top"></div>
            
            <div class="paper-texture p-8 md:p-10 text-left">
                
                <h2 class="font-serif text-3xl font-bold text-center text-[#4A2C11] mb-1">Resi Donasi</h2>
                <p class="text-[11px] font-mono text-center text-[#4A2C11]/50 mb-8 pb-4 border-b border-[#D2A770]/40 border-dashed tracking-wider">
                    No. Transaksi : {{ $donation->tracking_code ?? 'YKIP-REG-2026' }}
                </p>
                
                <div class="space-y-4 text-sm mb-6 font-medium">
                    <div class="flex justify-between items-center">
                        <span class="text-[#4A2C11]/70">Tanggal</span>
                        <span class="text-[#4A2C11]">{{ $donation->created_at->format('d / m / y') ?? date('d / m / y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#4A2C11]/70">Nama</span>
                        <span class="text-[#4A2C11] uppercase tracking-wide">{{ $donation->donor->name ?? 'ZARRIN' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[#4A2C11]/70">Donasi</span>
                        <span class="font-bold text-[#4A2C11]">{{ $donation->donation_tier ?? 'Reguler' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-1 -mx-1 animate-highlight">
                        <span class="text-[#4A2C11]/70">Status</span>
                        <span class="font-bold text-[#3B2415] bg-[#D2A770]/20 px-2 py-0.5 rounded-full text-xs border border-[#D2A770]/50 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            Berlangganan ({{ $donation->frequency ?? '3 Bulan' }})
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-[#4A2C11]/70">Harga Dasar</span>
                        <span class="text-[#4A2C11]">RP. {{ number_format($donation->amount ?? 50000, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="pt-5 border-t-2 border-[#4A2C11] mt-2">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-[#4A2C11] text-base">Total Bayar</span>
                        <span class="text-sm text-[#4A2C11]/80">{{ $donation->donation_tier ?? 'Reguler' }} Cup</span>
                    </div>
                    <div class="flex justify-end mt-1">
                        <span class="font-serif font-bold text-2xl text-[#4A2C11]">Rp. {{ number_format($donation->amount ?? 50000, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-center text-[10px] text-[#4A2C11]/50 mt-6 italic">Yayasan Kemanusiaan Ibu Pertiwi</p>
                </div>
                
            </div>
            
            <div class="receipt-edge-bottom"></div>
        </div>
        
        <div class="mt-14 flex flex-col md:flex-row gap-4 justify-center items-center relative z-10">
            <button onclick="printInvoice()" class="w-full md:w-auto px-8 py-4 rounded-full bg-white border-2 border-[#3B2415] text-[#3B2415] font-bold text-[15px] shadow-sm hover:bg-[#EAE5DB] transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download Invoice
            </button>
            
            <a href="{{ route('landing') }}" class="w-full md:w-auto px-10 py-4 rounded-full bg-[#3B2415] border-2 border-[#3B2415] text-white font-bold text-[15px] shadow-[0_8px_15px_rgba(59,36,21,0.3)] hover:scale-[1.02] hover:bg-[#2a1608] transition-all">
                Kembali ke Home
            </a>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // ==========================================
    // 1. ISOLATED INVOICE PRINTING FUNCTION
    // ==========================================
    function printInvoice() {
        // Clone the receipt so we don't mess up the actual page
        const receipt = document.getElementById('receipt-card').cloneNode(true);
        
        // Grab the Tailwind styles from the current document
        const styles = document.head.innerHTML;
        
        // Open a hidden/temporary window to process the print
        const printWindow = window.open('', '_blank', 'width=800,height=900');
        
        // Inject ONLY the receipt into the new window, stripped of animations/shadows
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                ${styles}
                <title>Invoice Donasi YKIP</title>
            </head>
            <body class="print-window-body">
                ${receipt.outerHTML}
                <script>
                    // Wait a split second for Tailwind classes to process, then print
                    window.onload = () => {
                        setTimeout(() => {
                            window.print();
                            window.close();
                        }, 300);
                    };
                <\/script>
            </body>
            </html>
        `);
        printWindow.document.close();
    }

    // ==========================================
    // 2. LOADER & ENTRANCE ANIMATION SEQUENCE
    // ==========================================
    document.addEventListener('DOMContentLoaded', () => {
        const loader = document.getElementById('success-loader');
        const mainContent = document.getElementById('main-content');
        const receiptCard = document.getElementById('receipt-card');

        // Let the GoPay Loader sit for 2.5 seconds
        setTimeout(() => {
            // Fade out the full-screen loader overlay
            loader.style.opacity = '0';
            
            setTimeout(() => {
                loader.style.display = 'none';
                
                // Show main content and trigger the Bottom-to-Top slide up
                mainContent.classList.remove('hidden');
                mainContent.classList.add('animate-screen-up');
                
                // Trigger the Receipt "Printing" drop-down animation
                receiptCard.classList.add('animate-receipt-print');
                
            }, 500); // Wait 0.5s for CSS loader fade out
            
        }, 2500); 
    });
</script>
@endpush
@endsection