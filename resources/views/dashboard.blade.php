<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<<div class="" style="display: flex; flex-wrap: wrap; justify-content: center;">
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
            <small class="ml-2 text-sm text-gray-600">{{ $article->created_at->format('j M Y, g:i a') }}</small>
            @unless ($article->created_at->eq($article->updated_at))
                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
            @endunless
            @if ($article->user->is(auth()->user()))
                <a href="{{ route('articles.edit', $article) }}" class="block bg-blue-500 text-black px-4 py-2 rounded mt-2">Edit</a>
            @endif
        </div>
    </div>
</div>



    @endforeach
</div>



</x-app-layout>
