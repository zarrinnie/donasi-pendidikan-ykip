<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-[#3E2723] leading-tight">
            {{ isset($package) ? 'Edit Package' : 'Create Package' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 bg-[#FDFBF7]">
                    
                    <form action="{{ isset($package) ? route('admin.packages.update', $package) : route('admin.packages.store') }}" method="POST">
                        @csrf
                        @if(isset($package))
                            @method('PUT')
                        @endif

                        <div class="space-y-6 bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                            
                            <div>
                                <x-input-label for="name" value="Package Name" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $package->name ?? '')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="amount" value="Amount (Rp)" />
                                <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full" :value="old('amount', $package->amount ?? '')" required />
                                <p class="text-xs text-gray-500 mt-1">Use 0 for custom amount packages.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                            </div>

                            <div>
                                <x-input-label for="description" value="Description" />
                                <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $package->description ?? '')" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="icon" value="Emoji Icon (Optional)" />
                                    <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full" :value="old('icon', $package->icon ?? '')" />
                                </div>
                                <div>
                                    <x-input-label for="sort_order" value="Sort Order" />
                                    <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-full" :value="old('sort_order', $package->sort_order ?? '0')" required />
                                </div>
                            </div>

                            <div class="flex items-center gap-6 mt-4">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_custom" value="1" class="rounded border-gray-300 text-[#D4A373] shadow-sm focus:ring-[#D4A373]" {{ old('is_custom', $package->is_custom ?? false) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Is Custom Amount?</span>
                                </label>

                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-[#D4A373] shadow-sm focus:ring-[#D4A373]" {{ old('is_active', $package->is_active ?? true) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Active (Visible)</span>
                                </label>
                            </div>

                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('admin.packages.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">Cancel</a>
                            <x-primary-button>{{ isset($package) ? 'Update Package' : 'Create Package' }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
