<?php

namespace App\Http\Controllers;

use App\Models\AdminToParents;
use Illuminate\Http\Request;

class AdminToParentsController extends Controller
{
    public function index()
    {
        return view('messages.adminToParents')->with('messages',AdminToParents::all());
    }
    
    // public function store(Request $request)
    // {
    //     AdminToParents::create([
    //         'user_id' => $request->user_id ,
    //         'parents_id' => $request->parents_id ,
    //         'title' => $request->title ,
    //         'message' => $request->message ,
    //     ]);

    //     return view('admin.messages.getadmintoparent')->with('messages',AdminToParents::all());
    // }
}
