<?php

namespace App\Http\Controllers;

use App\Models\class_room;
use App\Models\subjects;
use App\Models\teachers;
use Illuminate\Http\Request;

class subjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subjects.index')->with('subjects',subjects::all())
        ->with('teachers' , teachers::all())->with('classrooms' , class_room::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create')->with('ClassRooms',class_room::all())
        ->with('teachers',teachers::all()); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        subjects::create([
            'name' => $request->name ,
            'teacher_id'=> $request->teacher_id ,
            'class_room_id'=> $request->class_room_id ,
    
        ]);

        return redirect(route('admin.subjects_index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubjectClass($id)
    {
        return view('subjects.subjects_class')
        ->with('subjects',subjects::all()->where('class_room_id',$id));
    }
    //
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
    public function update(Request $request, subjects $subjects)
    {
        $subjects->update([
            'name' => $request->name ,
            'teacher_id'=> $request->teacher_id ,
            'class_room_id'=> $request->class_room_id ,
    
        ]);

        return redirect(route('admin.subjects_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        subjects::destroy($id);
        return redirect(route('admin.subjects_index'));
    }
}
