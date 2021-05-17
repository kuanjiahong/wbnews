<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News Articles') }}
        </h2>
        <a class="text-blue-700" href="/dashboard">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @can('publish article')
                        <button class="py-2 px-4 font-semibold  rounded-lg shadow-md text-white bg-green-500 hover:bg-green-700">
                            <a href="/articles/create">
                                Create article
                            </a>
                        </button>     
                    @endcan

                    <div class="py-2 space-y-3">
                        @forelse ($articles as $article )
                        <ul class="list-disc">
                            <li><a class="text-blue-700" href="/articles/{{ $article->id }}">{{ ucfirst($article->title) }}</a></li>
                        </ul>
                        @empty
                            <p>No article available</p>
                        @endforelse
                    
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>



