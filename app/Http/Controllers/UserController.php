<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $existingUsers = User::all();
        return view('users.index',[
            'users' => $existingUsers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $selectedUser = User::find($id);
        $selectedUserPic = $selectedUser->getMedia();
        $currentUser = Auth::user();
        //dd($selectedUser->hasAnyPermission(['publish article', 'unpublish article']) == false);
        return view('users.edit',[
            'selectedUser' => $selectedUser,
            'selectedUserPic' =>$selectedUserPic,
            'authUser' => $currentUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //dd($request->image == null);
        $selectedUser = User::find($id);
        $userProfilePic = $selectedUser->getMedia();

        $selectedUser->name=$request->input('name');
        $selectedUser->email=$request->input('email');

        //Role handling
        if ($selectedUser->id != Auth::id())
        {
        $selectedUser->syncRoles($request->input('role'));
        }


        //Picture handling
        if($request->image == null)
        {
            $selectedUser->save();
            return redirect('/users')->with('success','User edited successfully without image');
        }
        elseif($selectedUser->hasMedia())
        {
            $userProfilePic[0]->delete();
            $selectedUser->addMediaFromRequest('image')->toMediaCollection();
        }else 
        {
            $selectedUser->addMediaFromRequest('image')->toMediaCollection();
        }


        $selectedUser->save();

        return redirect('/users')->with('success','User edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser = Auth::user();
        $toBeDeletedUser = User::find($id);

        //Preventing user deleting itself
        if($currentUser->id != $toBeDeletedUser->id){
            $toBeDeletedUser->delete();
            return redirect()->route('users.index')
                    ->with('success','User deleted successfully');
        }else{
            return redirect()->route('users.index')
                    ->with('failure','You cannot delete yourself');
        }
    }
}
