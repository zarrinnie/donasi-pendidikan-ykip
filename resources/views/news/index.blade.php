<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('News') }}
            </h2>
            <a href="{{ route('news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create News
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border-b py-2 px-4">Title</th>
                                <th class="border-b py-2 px-4">Author</th>
                                <th class="border-b py-2 px-4">Published Date</th>
                                <th class="border-b py-2 px-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <td class="border-b py-2 px-4">{{ $item->title }}</td>
                                    <td class="border-b py-2 px-4">{{ $item->user->name ?? 'Unknown' }}</td>
                                    <td class="border-b py-2 px-4">{{ $item->created_at->format('M d, Y') }}</td>
                                    <td class="border-b py-2 px-4 text-right flex justify-end gap-2">
                                        <a href="{{ route('news.show', $item) }}" class="text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('news.edit', $item) }}" class="text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('news.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this news item?');">
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
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>