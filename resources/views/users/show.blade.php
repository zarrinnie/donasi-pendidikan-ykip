<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <strong>ID:</strong> {{ $user->id }}
                    </div>
                    <div class="mb-4">
                        <strong>Name:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-4">
                        <strong>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-4">
                        <strong>Email Verified:</strong> {{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : 'Not verified' }}
                    </div>
                    <div class="mb-6">
                        <strong>Account Created:</strong> {{ $user->created_at->format('Y-m-d H:i:s') }}
                    </div>

                    <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Back to List
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>