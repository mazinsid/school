<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class NewsController extends Controller
{
    public function create()
    {
        return view('News.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        News::create([
            'title' => $request->title ,
            'descrption'=> $request->descrption ,
    
        ]);

        return redirect(route('admin.News.create'));
    }
}
