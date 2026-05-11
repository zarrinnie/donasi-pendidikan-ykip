<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-[#3E2723] leading-tight">
            {{ __('Manage Donation Packages') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showDeleteModal: false, deleteActionUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 bg-[#FDFBF7]">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-serif text-xl font-bold text-[#3E2723]">All Packages</h3>
                        <a href="{{ route('admin.packages.create') }}" class="px-4 py-2 bg-[#D4A373] text-white rounded-lg shadow hover:bg-opacity-90 font-semibold text-sm transition">
                            + Add New Package
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-100">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-[#3E2723] uppercase bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4">Sort Order</th>
                                    <th class="px-6 py-4">Icon</th>
                                    <th class="px-6 py-4">Name</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4">Type</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($packages as $package)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4">{{ $package->sort_order }}</td>
                                        <td class="px-6 py-4 text-xl">{{ $package->icon }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-900">{{ $package->name }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($package->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            @if($package->is_custom)
                                                <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">Custom</span>
                                            @else
                                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Fixed</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($package->is_active)
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Active</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                                            <a href="{{ route('admin.packages.edit', $package) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                            <button type="button" @click="showDeleteModal = true; deleteActionUrl = '{{ route('admin.packages.destroy', $package) }}'" class="text-red-500 hover:text-red-800 font-medium transition">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">No packages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $packages->links() }}</div>

                </div>
            </div>
        </div>
        <!-- Alpine Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                            <h3 class="text-lg font-medium leading-6 text-gray-900 font-serif" id="modal-title">Delete Package</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this donation package? It will no longer appear on the public form. This action cannot be undone.</p>
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
