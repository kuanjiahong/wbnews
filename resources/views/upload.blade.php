<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Picture') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="alert alert-danger text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                     @endif

                    <form action="/dashboard" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p>Name</p>
                        <p>{{ $currentUser->name }}</p>
                        <p>Email</p>
                        <p>{{ $currentUser->email }}</p>
                        <p>Current Display Picture</p>
                        @if ($currentUser->hasMedia())
                            <img src="{{ $currentUserProfilePic[0]->getUrl('profile') }}" alt="">
                            <br>
                            <p>Change picture</p>
                        @else
                            <p>No image available</p>
                            <br>
                            <p>Upload picture</p>
                        @endif
                        <input type="file" name='image'>
                        <br>
                        <br>
                        <button
                            class="py-2 px-4 font-semibold  rounded-lg shadow-md text-white bg-green-500 hover:bg-green-700" 
                            type="submit"> Upload Picture</button>
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>




