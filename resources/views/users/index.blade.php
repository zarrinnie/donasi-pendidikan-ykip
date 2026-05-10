<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b py-2 px-4">Name</th>
                                <th class="border-b py-2 px-4">Email</th>
                                <th class="border-b py-2 px-4">Registered</th>
                                <th class="border-b py-2 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="border-b py-2 px-4">{{ $user->name }}</td>
                                    <td class="border-b py-2 px-4">{{ $user->email }}</td>
                                    <td class="border-b py-2 px-4">{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="border-b py-2 px-4 text-right flex justify-end gap-2">
                                        <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>