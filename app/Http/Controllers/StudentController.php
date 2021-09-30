<?php

namespace App\Http\Controllers;

use App\Models\class_room;
use App\Models\students;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ParentStudents(){
        $iduser = Auth::user()->id;
        return view('students.parent_students')->with('students',students::all()->where('parent_id',$iduser));
    }
    //
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $id_user = Auth::user()->id;
        students::create([
            'full_name' => $request->full_name ,
            'brith'=> $request->brith ,
            'address'=> $request->address ,
            'class_room_id'=> $request->class_room_id ,
            'last_result' => $request->last_result->store('result','public'),
            'birth_certificate' => $request->birth_certificate->store('birth','public'),
            'id_number' => $request->id_number->store('idnumber','public'),
            'image' => $request->image->store('images/studends','public'),
            'user_id'=> $request->user_id ,
            'parent_id'=> $id_user 
        ]);

        return redirect(route('parent.students'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //
    
    public function insert($id)
    {
        $stud_id = 0;
        $students = students::all()->where('user_id',$id);
        foreach($students as $student){
            $stud_id = $student->id;
        }
        if($stud_id != 0){
            return redirect(route('edit.students',$stud_id));
        }else{
            return view('students.insert_info')->with('id',$id)
            ->with('classrooms',class_room::all());
        }
        
    }
    // show
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('students.update_info')->with('students',students::all()->where('id',$id))
        ->with('classrooms',class_room::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, students $student)
    {
        $data = $request->only(['full_name','brith' , 'address' , 'classroom']);

               //image update
        if ($request->hasFile('image')){
            $image = $request->image->store('images/studends','public');
            Storage::disk('public')->delete($student->image);
            $data['image']= $image;
        }
               //birth_certificate last_result
        if ($request->hasFile('last_result')){
            $last_result = $request->last_result->store('result','public');
            Storage::disk('public')->delete($student->last_result);
            $data['last_result']= $last_result;
        }
           //birth_certificate update
        if ($request->hasFile('birth_certificate')){
            $birth_certificate = $request->birth_certificate->store('birth','public');
            Storage::disk('public')->delete($student->birth_certificate);
            $data['birth_certificate']= $birth_certificate;
        }
   //id_number update
        if ($request->hasFile('id_number')){
            $id_number = $request->id_number->store('idnumber','public');
            Storage::disk('public')->delete($student->id_number);
            $data['id_number']= $id_number;
        }

        $student->update($data);
        session()->flash('success','Update Item successfully');
        return redirect(route('parent.students'));
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
