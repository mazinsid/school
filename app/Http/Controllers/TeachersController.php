<?php

namespace App\Http\Controllers;

use App\Models\lectures;
use App\Models\students;
use Illuminate\Http\Request;
use App\Models\teachers;
use App\Models\subjects;
use App\Models\evaluation;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage ;
class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teachers.index')->with('theachers',teachers::all());
    }

    // to get teacher subject
    public function getSubject()
    {
        $iduser = Auth::user()->id;
        $tech_id = DB::table('teachers')->where('user_id',$iduser)->value('id');

        return view('viewsteacher.teachersubject')->
        with('subjects',subjects::all()->where('teacher_id',$tech_id));
    }
    // get student class room techer
    public function getClassRoom($subject,$classroom)
    {
        $class_name = DB::table('class_rooms')->where('id',$classroom)->value('name');
        return view('viewsteacher.classroom')
        ->with('class_name',$class_name)->with('subject',$subject)->
        with('students',students::all()->where('class_room_id',$classroom));
    }
    // get leacture 
    public function getLectures($id)
    {
        return view('viewsteacher.lectures')->with('lectures',lectures::all()->
        where('subject_id',$id))->with('subject',subjects::all()->where('id',$id)->first());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    public function evaluations($studant , $subject)
    {
        $evaluations = evaluation::all()->where('subject_id',$subject)->where('student_id',$studant);

        if($evaluations->isNotEmpty()){
            foreach($evaluations as $evaluation)
            {
                $data = $evaluation;
            }
         return view('viewsteacher.evaludations_edit')->with('evaluations',$data);   
        }else{
         return view('viewsteacher.evaluations')->with('studant',$studant)
         ->with('subject',$subject);
    
        }
    }

    public function EvaluationٍٍStore(Request $request)
    {
        evaluation::create([
            'subject_id' => $request->subject_id ,
            'student_id'=> $request->student_id ,
            'evaluation'=> $request->evaluation ,
            'note'=> $request->note ,
        ]);

        $subjects = subjects::all()->where('id',$request->subject_id);
        foreach($subjects as $subject){
            $classroom = $subject->class_room_id;
        }
        $class_name = DB::table('class_rooms')->where('id',$classroom)->value('name');
        return view('viewsteacher.classroom')->with('class_name',$class_name)->with('subject',$request->subject_id)->
        with('students',students::all()->where('class_room_id',$classroom));
    }

    public function EvaluationٍٍUpdate(Request $request , evaluation $evaluation)
    {
       $evaluation->update([
            'subject_id' => $request->subject_id ,
            'student_id'=> $request->student_id ,
            'evaluation'=> $request->evaluation ,
            'note'=> $request->note ,
        ]);

        $subjects = subjects::all()->where('id',$request->subject_id);
        foreach($subjects as $subject){
            $classroom = $subject->class_room_id;
        }
        $class_name = DB::table('class_rooms')->where('id',$classroom)->value('name');
      
        return view('viewsteacher.classroom')->with('class_name',$class_name)->with('subject',$request->subject_id)->
        with('students',students::all()->where('class_room_id',$classroom));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        teachers::create([
            'name' => $request->name ,
            'subject'=> $request->subject ,
            'user_id'=> $request->user_id ,
            'cv' => $request->cv->store('cv','public'),
            'image' => $request->image->store('images/teachers','public')
        ]);

        return redirect(route('admin.teachers'));
    }

    
    public function insert($id)
    {
        $tech_id = 0;
        $teachers = teachers::all()->where('user_id',$id);
        foreach($teachers as $teacher){
            $tech_id = $teacher->id;
        }
        if($tech_id != 0){
            return redirect(route('admin.teacher.edit',$tech_id));
        }else{
            return view('teachers.insert_info')->with('id',$id);
        }
        
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
        return view('teachers.update_info')->with('teachers',teachers::all()->where('id',$id));
    
    }


    // get user teacher uncomplet info

    public function account()
    {
        return view('teachers.account')->with('teachers',User::all()->where('role','teacher'));
    }

    // active and unactive acoutne
    public function active($user)
    {
        DB::table('users')
        ->where('id', $user)
        ->update(['state' => "active"]);
        session()->flash('success','Update state successfully');
        return redirect(route('admin.teacher.account'));
    }
    public function unactive($user)
    {
        DB::table('users')
        ->where('id', $user)
        ->update(['state' => "Inactive"]);
        session()->flash('success','Update state successfully');
        return redirect(route('admin.teacher.account'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, teachers $teacher)
    {
         $data = $request->only(['name','subject' ]);

                //image update
        if ($request->hasFile('image')){
            $image = $request->image->store('images/teacher','public');
            Storage::disk('public')->delete($teacher->image);
            $data['image']= $image;
        }
                // cv
        if ($request->hasFile('last_result')){
            $cv = $request->last_result->store('cv','public');
            Storage::disk('public')->delete($teacher->cv);
            $data['cv']= $cv;
        }

        $teacher->update($data);
        session()->flash('success','Update Item successfully');
        return redirect(route('admin.teachers'));
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
