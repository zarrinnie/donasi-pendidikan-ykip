<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-[#3E2723] leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- KPIs -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- KPI 1 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                        <h3 class="text-2xl font-bold text-[#3E2723]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <!-- KPI 2 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Donors</p>
                        <h3 class="text-2xl font-bold text-[#3E2723]">{{ number_format($totalDonors) }}</h3>
                    </div>
                </div>

                <!-- KPI 3 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="h-12 w-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Donations</p>
                        <h3 class="text-2xl font-bold text-[#3E2723]">{{ number_format($totalDonations) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Revenue Line Chart -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
                    <h3 class="font-serif text-lg font-bold text-[#3E2723] mb-4">Revenue Over Time (30 Days)</h3>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Tier Distribution Doughnut -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-serif text-lg font-bold text-[#3E2723] mb-4">Donation Tiers</h3>
                    <div class="relative h-72 w-full flex justify-center">
                        <canvas id="tierChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Donations Mini-table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-serif text-lg font-bold text-[#3E2723]">Recent Donations</h3>
                    <a href="{{ route('admin.donations.index') }}" class="text-sm text-[#D4A373] hover:text-[#3E2723] font-semibold">View All &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-400 uppercase border-b border-gray-100">
                            <tr>
                                <th class="py-3 font-medium">Donor</th>
                                <th class="py-3 font-medium">Amount</th>
                                <th class="py-3 font-medium">Tier</th>
                                <th class="py-3 font-medium">Status</th>
                                <th class="py-3 font-medium text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentDonations as $donation)
                                <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50 transition">
                                    <td class="py-3 font-medium text-gray-900">{{ $donation->donor->name }}</td>
                                    <td class="py-3 font-bold text-[#3E2723]">Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                    <td class="py-3">{{ $donation->donation_tier }}</td>
                                    <td class="py-3">
                                        @if($donation->payment_status === 'Success')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Success</span>
                                        @else
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-medium">{{ $donation->payment_status }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-right text-gray-500">{{ $donation->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">No recent donations.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Revenue Line Chart
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            const dates = {!! json_encode($chartDates) !!};
            const revenues = {!! json_encode($chartRevenues) !!};
            
            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Revenue (Rp)',
                        data: revenues,
                        borderColor: '#D4A373',
                        backgroundColor: 'rgba(212, 163, 115, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#3E2723',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#3E2723',
                            titleFont: { family: 'serif', size: 14 },
                            bodyFont: { size: 13 },
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let value = context.raw || 0;
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6', drawBorder: false },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + (value/1000) + 'k';
                                },
                                color: '#9ca3af',
                                font: { size: 11 }
                            }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#9ca3af', font: { size: 11 } }
                        }
                    }
                }
            });

            // Tier Distribution Doughnut
            const ctxTier = document.getElementById('tierChart').getContext('2d');
            const tierData = {!! json_encode($tierDistribution) !!};
            const labels = Object.keys(tierData);
            const data = Object.values(tierData);
            
            // Coffee theme colors
            const bgColors = [
                '#3E2723', // Dark Coffee
                '#D4A373', // Caramel
                '#FAEDCD', // Cream
                '#A98467', // Mocha
                '#E3D5CA'
            ];

            new Chart(ctxTier, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: bgColors,
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: { family: 'sans-serif', size: 12 },
                                color: '#4b5563'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#3E2723',
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.label + ': ' + context.raw + ' donations';
                                }
                            }
                        }
                    }
                }
            });
            
        });
    </script>
    @endpush
</x-app-layout>
