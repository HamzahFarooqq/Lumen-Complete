<?php

namespace app\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    function list()
    {
        return Article::all();

        // return response()->json(['article' => $article]) ;
    }



    function save(Request $request)
    {

        // if(auth()->check())
        // {




            $article = Article::create($request->input());
    
            return response()->json(['article' => $article]) ;


            

        // } else {

        //     return response()->json(['message' => 'user is not authenticated !']) ;            
        // }

    }

    
}