<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tous les articles') }}
        </h2>
    </x-slot>

    <div class="flex justify-center mb-4">
        <form action="{{ route('blog') }}" method="GET">
            <label for="sortOrder" class="mr-2">Trier par :</label>
            <select name="sortOrder" id="sortOrder" onchange="this.form.submit()">
                <option value="desc" @if($sortOrder === 'desc') selected @endif>Du plus récent au plus ancien</option>
                <option value="asc" @if($sortOrder === 'asc') selected @endif>Du plus ancien au plus récent</option>
            </select>
        </form>
    </div>

    <div class="flex flex-wrap justify-center">
        @foreach($articles as $article)
            <a href="{{ route('article.show', $article->id) }}" class="w-300px px-4 mb-8 mt-4 relative" style="max-width: 300px">
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
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
