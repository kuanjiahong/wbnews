<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    
    public function index(){
        //$currentUser = User::find(Auth::id());
        $currentUser = Auth::user();
        return view('dashboard',[
            'currentUserProfilePic' => $currentUser->getMedia(),
            'currentUser' => $currentUser,
        ]);
    }

    public function create(){
        $currentUser = Auth::user();
        return view('upload',[
            'currentUser'=>$currentUser
        ]);
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        $currentUserProfilePic = $currentUser->getMedia();
        if($currentUser->hasMedia())
        {
            $currentUserProfilePic[0]->delete();
            $currentUser->addMediaFromRequest('image')->toMediaCollection();
        }else
        {
            $currentUser->addMediaFromRequest('image')->toMediaCollection();
        }
        return view('dashboard',[
            'currentUser' =>$currentUser,
            'currentUserProfilePic' => $currentUser->getMedia(),
        ]);
    }

}