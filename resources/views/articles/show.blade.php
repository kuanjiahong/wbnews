<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(ucfirst($article->title)) }}
        </h2>
        <a class="text-blue-700" href="/articles">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($article->hasMedia())
                        <img src="{{ $picture[0]->getUrl('thumb') }}" alt="Article picture">
                        @else
                            <p class="italic">This article has no image</p>
                    @endif
                    <h1 class="text-4xl"><b>{{ ucfirst($article->title) }}</b></h1>
                    <span class="mr-3">Written by: {{ ucfirst($author->name) }}</span>
                    <span class="px-2">Publish on : {{ $article->created_at }}</span>
                    <span>Last updated on : {{ $article->updated_at }}</span>

                    <p class="py-3">{!! $article->body !!}</p>

                    @can('publish article','unpublish article')
                        <a class="px-1 font-semibold  rounded-lg shadow-md text-white bg-green-500 hover:bg-green-700" 
                            href="/articles/{{ $article->id }}/edit">
                            Edit Article</a>
                    <form action="/articles/{{ $article->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="px-1 font-semibold  rounded-lg shadow-md text-white bg-red-500 hover:bg-red-700">Delete Post</button>
                    </form>
                
                
                @endcan

                       
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
