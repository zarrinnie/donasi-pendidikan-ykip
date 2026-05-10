<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-2">{{ $news->title }}</h1>
                    
                    <div class="text-sm text-gray-500 mb-6">
                        Published by <strong>{{ $news->user->name ?? 'Unknown Author' }}</strong> on {{ $news->created_at->format('F d, Y') }}
                    </div>

                    <div class="mb-8 prose max-w-none">
                        {!! nl2br(e($news->description)) !!}
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('news.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                        <a href="{{ route('news.edit', $news) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>