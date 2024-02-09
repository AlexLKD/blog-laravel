<x-app-layout>
<x-slot name="header" class="">
    <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <a href="{{ route('blog') }}" class="text-gray-500 hover:text-gray-700 border-round">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        {{ $article->title }}
    </h2>
</x-slot>

<div class="container">
    <div class="row justify-content-center">
        <div class="article-content col-10">
            <div class="artcl-img">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid artcl-sub-img">
            </div>
            <p class="mt-4">{{ $article->content }}</p>
        </div>
    </div>
</div>

<p> Commentaires: </p>
</x-app-layout>
