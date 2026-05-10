<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-[#3E2723] leading-tight">
            {{ __('Manage Donors') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showEditModal: false, editDonorId: '', editName: '', editEmail: '', editPhone: '', editOccupation: '', editGender: '', showDeleteModal: false, deleteActionUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('message'))
                <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 bg-[#FDFBF7] border-b border-gray-100 flex flex-col md:flex-row gap-4 justify-between items-center">
                    
                    <form action="{{ route('admin.donors.index') }}" method="GET" class="w-full md:w-1/2 flex gap-2">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" name="search" value="{{ request('search') }}" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-[#D4A373] focus:border-[#D4A373]" placeholder="Search by Name, Email, Phone...">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-[#3E2723] text-white rounded-lg text-sm font-medium hover:bg-opacity-90">Search</button>
                        @if(request('search'))
                            <a href="{{ route('admin.donors.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg text-sm font-medium hover:bg-gray-300">Clear</a>
                        @endif
                    </form>
                </div>

                <div class="overflow-x-auto bg-white relative">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-[#3E2723] uppercase bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4">Donor Name</th>
                                <th class="px-6 py-4">Contact Info</th>
                                <th class="px-6 py-4">Occupation</th>
                                <th class="px-6 py-4">Joined</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donors as $donor)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900 text-base">{{ $donor->name }}</div>
                                        <div class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                            {{ $donor->gender ?? 'Not Specified' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900">{{ $donor->email }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $donor->phone ?? 'No phone' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $donor->occupation ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $donor->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-3 items-center h-full pt-6">
                                        <button @click="showEditModal = true; editDonorId = '{{ $donor->id }}'; editName = '{{ addslashes($donor->name) }}'; editEmail = '{{ addslashes($donor->email) }}'; editPhone = '{{ addslashes($donor->phone) }}'; editOccupation = '{{ addslashes($donor->occupation) }}'; editGender = '{{ addslashes($donor->gender) }}'" class="text-[#D4A373] hover:text-[#3E2723] font-medium transition">Edit</button>
                                        <button type="button" @click="showDeleteModal = true; deleteActionUrl = '{{ route('admin.donors.destroy', $donor) }}'" class="text-red-500 hover:text-red-800 font-medium transition">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">No donors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    {{ $donors->links() }}
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
                                    <h2 class="text-xl font-serif font-bold text-[#3E2723]">Edit Donor</h2>
                                    <button type="button" @click="showEditModal = false" class="text-gray-400 hover:text-gray-500">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative flex-1 px-4 py-6 sm:px-6">
                                <form :action="`/admin/donors/${editDonorId}`" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                                        <input type="text" name="name" x-model="editName" required class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4A373] focus:ring focus:ring-[#D4A373] focus:ring-opacity-50 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                                        <input type="email" name="email" x-model="editEmail" required class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4A373] focus:ring focus:ring-[#D4A373] focus:ring-opacity-50 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                                        <input type="tel" name="phone" x-model="editPhone" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4A373] focus:ring focus:ring-[#D4A373] focus:ring-opacity-50 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Occupation</label>
                                        <input type="text" name="occupation" x-model="editOccupation" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4A373] focus:ring focus:ring-[#D4A373] focus:ring-opacity-50 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1">Gender</label>
                                        <select name="gender" x-model="editGender" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4A373] focus:ring focus:ring-[#D4A373] focus:ring-opacity-50 text-sm">
                                            <option value="">Select Gender</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end gap-3">
                                        <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-50 transition shadow-sm">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-[#3E2723] text-white rounded-lg text-sm font-medium hover:bg-opacity-90 transition shadow-sm">Save Changes</button>
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
                            <h3 class="text-lg font-medium leading-6 text-gray-900 font-serif" id="modal-title">Delete Donor</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this donor? This will also delete all their donations. This action cannot be undone.</p>
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
