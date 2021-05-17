<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit article') }}
        </h2>
        <a class="text-blue-700" href="/articles">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-4xl">Edit and submit this form to update a post</p>
                    <form action="/articles/{{ $article->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label for="title">Article Title</label>
                        <br>
                        <input 
                            type="text" 
                            name="title" 
                            id="title"
                            placeholder="Enter article title"
                            value="{{ $article->title }}">
                        <br>
                        <label for="body">Article body</label>
                        <br>
                        <textarea 
                            name="body" 
                            id="body" 
                            cols="80" 
                            rows="20"
                            placeholder="Enter article body">
                        {{ $article->body }}
                        </textarea>
                        <br>
                        <input class="py-2" type="file" name="image">
                        <br>
                        <button
                            class="py-2 px-4 font-semibold  rounded-lg shadow-md text-white bg-green-500 hover:bg-green-700" 
                            type="submit">
                            Update Article
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>





