<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\User;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('id','desc')->get();
        // $articles = DB::table('articles')
        //             ->orderBy('id','desc')
        //             ->get();
        return view('articles.index',[
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title'=>['required'],
            'body'=>['required'],
        ]);
        $newArticle = Article::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'writer_id'=>Auth::id(),
        ]);
        if($request->image == null)
        {
            return redirect('articles/'.$newArticle->id);
        }
        $newArticle->addMediaFromRequest('image')->toMediaCollection();
        return redirect('articles/'.$newArticle->id);
    }

    public function show(Article $article)
    {
        $selectedArticle = Article::find($article->id);
        $picture = $selectedArticle->getMedia();
        $author = User::find($article->writer_id);
        return view('articles.show',[
            'article' => $article,
            'author' => $author, 
            'picture' => $picture,
        ]);
    }

    public function edit(Article $article)
    {
        return view('articles.edit',[
            'article'=>$article,
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $articlePic = $article->getMedia();
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        
        if($request->image==null)
        {
            $article->save();
            return redirect('articles/'.$article->id);

        }elseif($article->hasMedia())
        {
            $articlePic[0]->delete();
            $article->addMediaFromRequest('image')->toMediaCollection();
        }else 
        {
            $article->addMediaFromRequest('image')->toMediaCollection();
        }
        $article->save();

        return redirect('articles/'.$article->id);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/articles');
    }
}
