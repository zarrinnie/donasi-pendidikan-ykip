<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-[#3E2723] leading-tight">
            {{ __('Manage Donations') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showEditModal: false, editDonationId: '', editPaymentStatus: '', editIsWelcomeEmailSent: false, showDeleteModal: false, deleteActionUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('message'))
                <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 shadow-sm" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 bg-[#FDFBF7] border-b border-gray-100">
                    
                    <form action="{{ route('admin.donations.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="w-full md:w-1/3">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Search</label>
                            <input type="search" name="search" value="{{ request('search') }}" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-[#D4A373] focus:border-[#D4A373]" placeholder="Name, Email, Receipt...">
                        </div>

                        <div class="w-full md:w-auto">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Tier</label>
                            <select name="filterTier" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-[#D4A373] focus:border-[#D4A373]">
                                <option value="">All Tiers</option>
                                <option value="Small" {{ request('filterTier') == 'Small' ? 'selected' : '' }}>Small</option>
                                <option value="Medium" {{ request('filterTier') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Large" {{ request('filterTier') == 'Large' ? 'selected' : '' }}>Large</option>
                                <option value="Custom" {{ request('filterTier') == 'Custom' ? 'selected' : '' }}>Custom</option>
                            </select>
                        </div>

                        <div class="w-full md:w-auto">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Frequency</label>
                            <select name="filterFrequency" class="block w-[200px] p-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-[#D4A373] focus:border-[#D4A373]">
                                <option value="">All Freqs</option>
                                <option value="3 Bulan" {{ request('filterFrequency') == '3 Bulan' ? 'selected' : '' }}>3 Bulan</option>
                                <option value="6 Bulan" {{ request('filterFrequency') == '6 Bulan' ? 'selected' : '' }}>6 Bulan</option>
                                <option value="1 Tahun" {{ request('filterFrequency') == '1 Tahun' ? 'selected' : '' }}>1 Tahun</option>
                            </select>
                        </div>

                        <div class="w-full md:w-auto flex gap-2">
                            <button type="submit" class="px-4 py-2 bg-[#3E2723] text-white rounded-lg text-sm font-medium hover:bg-opacity-90">Filter</button>
                            @if(request('search') || request('filterTier') || request('filterFrequency'))
                                <a href="{{ route('admin.donations.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg text-sm font-medium hover:bg-gray-300">Clear</a>
                            @endif
                        </div>
                    </form>

                </div>

                <div class="overflow-x-auto bg-white relative">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-[#3E2723] uppercase bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4">Receipt / Date</th>
                                <th class="px-6 py-4">Donor Details</th>
                                <th class="px-6 py-4">Donation Info</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Email Sent</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donations as $donation)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-mono text-xs text-gray-900">{{ $donation->receipt_number }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $donation->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $donation->donor->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $donation->donor->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-[#3E2723] font-semibold">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $donation->donation_tier }} • {{ $donation->frequency }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($donation->payment_status === 'Success')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">Success</span>
                                        @elseif($donation->payment_status === 'Pending')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-medium">Pending</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full font-medium">Failed</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($donation->is_welcome_email_sent)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium flex items-center gap-1 w-max">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Sent
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium flex items-center gap-1 w-max">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-3">
                                        <button @click="showEditModal = true; editDonationId = '{{ $donation->id }}'; editPaymentStatus = '{{ $donation->payment_status }}'; editIsWelcomeEmailSent = {{ $donation->is_welcome_email_sent ? 'true' : 'false' }}" class="text-[#D4A373] hover:text-[#3E2723] font-medium transition">Edit</button>
                                        <button type="button" @click="showDeleteModal = true; deleteActionUrl = '{{ route('admin.donations.destroy', $donation) }}'" class="text-red-500 hover:text-red-800 font-medium transition">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">No donations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    {{ $donations->links() }}
                </div>
            </div>
        </div>

        <!-- Alpine Edit Modal -->
        <div x-show="showEditModal" class="fixed inset-0 overflow-hidden z-50" style="display: none;" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden">
                <div x-show="showEditModal" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showEditModal = false" aria-hidden="true"></div>

                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div x-show="showEditModal" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="pointer-events-auto relative w-screen max-w-md">
                        
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="px-4 py-6 bg-[#FDFBF7] border-b border-gray-200 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-xl font-serif font-bold text-[#3E2723]" id="slide-over-title">Edit Donation</h2>
                                    <button type="button" @click="showEditModal = false" class="text-gray-400 hover:text-gray-500">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative flex-1 px-4 py-6 sm:px-6">
                                <form :action="`/admin/donations/${editDonationId}`" method="POST" class="space-y-6">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div>
                                        <label class="block text-sm font-medium leading-6 text-gray-900">Payment Status</label>
                                        <select name="payment_status" x-model="editPaymentStatus" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-[#D4A373] sm:text-sm sm:leading-6">
                                            <option value="Pending">Pending</option>
                                            <option value="Success">Success</option>
                                            <option value="Failed">Failed</option>
                                        </select>
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="is_welcome_email_sent" value="1" x-model="editIsWelcomeEmailSent" id="is_welcome_email_sent" class="h-4 w-4 rounded border-gray-300 text-[#D4A373] focus:ring-[#D4A373]">
                                            <label for="is_welcome_email_sent" class="text-sm font-medium leading-6 text-gray-900">Welcome Email Sent</label>
                                        </div>
                                    </div>

                                    <div class="pt-6 border-t border-gray-200 flex justify-end">
                                        <button type="submit" class="rounded-md bg-[#3E2723] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-opacity-90">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Alpine Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="showDeleteModal = false" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 font-serif" id="modal-title">Delete Donation</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this donation record? This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse gap-3">
                        <form :action="deleteActionUrl" method="POST" class="w-full sm:w-auto">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm transition">Yes, Delete</button>
                        </form>
                        <button type="button" @click="showDeleteModal = false" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4A373] sm:mt-0 sm:w-auto sm:text-sm transition">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
