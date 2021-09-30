<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentStoreRequest;
use App\Models\content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('contents.create')->with('lectuer_id' , $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->only(['type' , 'lecture_id']);
        if($request->type == 'image'){
            $file = $request->file->store('content/image','public');
            $date['file'] = $file ;
        }
        if($request->type == 'video'){
            $file = $request->file->store('content/video','public');
            $date['file'] = $file ;
        }
        if($request->type == 'voice'){
            $file = $request->file->store('content/voice','public');
            $date['file'] = $file ;
        }
        if($request->type == 'document'){
            $file = $request->file->store('content/document','public');
            $date['file'] = $file ;
        }
        content::create($date);

        return redirect(route('admin.lecture.index'));

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
