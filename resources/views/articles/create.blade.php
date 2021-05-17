<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create an Article') }}
        </h2>
        <a class="text-blue-700" href="/articles">Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-4xl">Fill and submit this form to create an article</p>

                    @if ($errors->any())
                        <div class="alert alert-danger text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/articles" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="title">Article Title</label>
                        <br>
                        <input 
                            type="text" 
                            name='title' 
                            placeholder="Enter Article title">
                    
                        <br>
                        <label for="body">Article Body</label>
                        <br>
                        <textarea 
                            name="body" 
                            id="body" 
                            cols="80" 
                            rows="20" 
                            placeholder="Enter article body">
                    
                        </textarea>
                        <br>
                        <input class="py-2" type="file" name= 'image'>
                        <br>
                        <button
                            class="py-2 px-4 font-semibold  rounded-lg shadow-md text-white bg-green-500 hover:bg-green-700"
                            type="submit">
                            Create article
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>

