<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Article;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();
        return view('dashboard',[
            'currentUserProfilePic' => $currentUser->getMedia(),
            'currentUser' => $currentUser,
            'allArticles' => Article::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentUser = Auth::user();
        $currentUserProfilePic = $currentUser->getMedia();
        return view('upload',[
            'currentUser'=> $currentUser,
            'currentUserProfilePic' => $currentUserProfilePic,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image'=>['required'],
        ]);
        $currentUser = Auth::user();
        $currentUserProfilePic = $currentUser->getMedia();

        if($request->image == null)
        {
            return redirect('dashboard')->with([
                'currentUser' =>$currentUser,
                'currentUserProfilePic' => $currentUser->getMedia(),
            ]);   
        }elseif($currentUser->hasMedia())
        {
            $currentUserProfilePic[0]->delete();
            $currentUser->addMediaFromRequest('image')->toMediaCollection();
        }else
        {
            $currentUser->addMediaFromRequest('image')->toMediaCollection();
        }
        return redirect('dashboard')->with([
            'currentUser' =>$currentUser,
            'currentUserProfilePic' => $currentUser->getMedia(),
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
