<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap justify-center">
        @foreach($articles as $article)
            <div class="w-300px px-4 mb-8 mt-4 relative" style="max-width: 300px">
                <div class="w-300px h-400px rounded overflow-hidden shadow-lg">
                    <img class="w-full h-200px object-cover" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $article->title }}</div>
                        <p class="text-gray-700 text-base">{{ substr($article->content, 0, 40) }}...</p>
                        @if($article->user)
                            <div class="text-gray-800">
                                Rédigé par : {{ $article->user->name }}
                            </div>
                        @endif
                        <small class="text-sm text-gray-600">
                            @if($article->created_at == $article->updated_at)
                                Créé le : {{ $article->created_at->format('j M Y, g:i a') }}
                            @else
                                Modifié le : {{ $article->updated_at->format('j M Y, g:i a') }}
                            @endif
                        </small>
                        <div class="flex mt-2">
                            <a href="{{ route('articles.edit', $article) }}" class="block bg-blue-500 text-black px-4 py-2 rounded mr-2">Edit</a>
                            <form action="{{ route('articles.destroy', $article) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="block bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
