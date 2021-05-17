<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!--Message-->
                    @if ($message = Session::get('success'))
                    <div style="color: green">
                      <p>{{ $message }}</p>
                    </div>
                    @elseif ($message = Session::get('failure'))
                    <div class="text-red-600">
                        <p>{{ $message }}</p>
                      </div>
                    @endif

                    <!--User Table-->
                    <table class="table-auto border-collapse border border-black-800">
                        <tr>
                            <th class="p-5 text-center border border-black-600">No</th>
                            <th class="p-5 text-center border border-black-600">Profile Pic</th>
                            <th class="p-5 text-center border border-black-600">Name</th>
                            <th class="p-5 text-center border border-black-600">Email</th>
                            <th class="p-5 text-center border border-black-600">Role</th>
                            <th class="p-5 text-center border border-black-600" colspan="2">Action</th>
                        </tr>
                    
                        @foreach ($users as $user)
                        <tr>
                            <td class=" text-center border border-black-600">{{ $user->id }}</td>

                            <!--Profile Picture-->
                            @if ($user->hasMedia())
                            @foreach($user->getMedia() as $v)
                                <td class="text-center border border-black-600">
                                    <img class="p-5 object-none object-center" src="{{ $v->getUrl('profile') }}" alt="Profile Picture">
                                    <br> 
                                    <a class="text-blue-700" href="/users/{{ $user->id }}/edit">Change</a></td>
                                @endforeach
                                @else
                                <!--Upload Picture-->
                                <td class="text-blue-700 text-center border border-black-600">
                                    <a href="/users/{{ $user->id }}/edit">
                                        Upload Picture
                                    </a>
                                </td>
                            @endif

                            <td class="p-5 text-center border border-black-600">{{ $user->name }}</td>
                            <td class="p-5 text-center border border-black-600">{{ $user->email }}</td>

                            {{-- Retrieve role from user --}}
                            @if (!empty($user->getRoleNames()[0]))
                                <td class="p-5 text-center border border-black-600">{{ $user->getRoleNames()[0] }}</td>
                                @else
                                    <td class="p-5 text-center border border-black-600">No role Assigned</td>
                            @endif

                            <!--Edit User detail-->
                            <td class="p-9 border border-black-600" style="color: green">
                                <a class='mr-1 text-green-600' href="/users/{{ $user->id }}/edit">Edit</a>
                                <!--Delete User-->
                                {{-- <td class="text-red-600"> --}}
                                <form class= 'float-right' action="/users/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ml-1 text-red-600" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                        @endforeach
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ $users->render() }} --}}
</x-app-layout>




