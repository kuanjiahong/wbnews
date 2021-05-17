<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }} 
        </h2>
        <a class="text-blue-700" href="/users">Back</a>
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

                    <form action="/users/{{ $selectedUser->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <p>Name</p>
                            <input 
                                type="text"
                                name="name"
                                value= {{ $selectedUser->name }}>
                            <br>
                            <p>Email</p>
                            <input 
                            type="text"
                            name="email"
                            value= {{ $selectedUser->email }}>
                            <br>
                            <p>Role</p>
                            @if ($authUser == $selectedUser)
                                <p class="font-black">Admin cannot change its own role</p>
                            @elseif ($selectedUser->hasAnyPermission(['publish article', 'unpublish article']) == false )
                                <select name="role">
                                    <option value="admin">admin</option>
                                    <option value="writer">writer</option>
                                    <option value="viewer" selected>viewer</option>
                                </select>
                                {{-- <input type="text" name='role' value="Assign a role"> --}}
                            @else
                                <select name="role">
                                    <option value="admin">admin</option>
                                    <option value="writer" selected>writer</option>
                                    <option value="viewer">viewer</option>
                                </select>
                                {{-- <input 
                                type="text"
                                name="role"
                                value= {{ $selectedUser->getRoleNames()[0] }}> --}}
                            @endif
                    
                            <p> Current Display Picture</p>
                            @if ($selectedUser->hasMedia())
                                <img src="{{ $selectedUserPic[0]->getUrl('profile') }}" alt="Profile Pic">
                                <br>
                                <p>Change picture</p>
                            @else
                                <p>No image submitted</p>
                                <p>Upload picture</p>
                            @endif
                            <input type="file" name="image">
                            <br>
                            <br>
                            <button class="text-green-600" type="submit">Edit</button>
                    </form>

                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>



