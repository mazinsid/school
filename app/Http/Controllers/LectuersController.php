<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\chat_leacture;
use App\Models\content;
use App\Models\evaluation;
use App\Models\lectures;
use App\Models\subjects;
use App\Models\teachers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\File;

class LectuersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lectures.index')->with('lectures',lectures::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lectures.create')->with('subjects',subjects::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // lectures::create([
        //     'subject_id' => $request->subject_id ,
        //     'number'=> $request->number ,
        //     'lectuer_date' => $request->lectuer_date ,
    
        // ]);
        $lectuer_id = DB::table('lectures')->latest('id')->first();
        $subjects = DB::table('subjects')->select('class_room_id')->where('id' , $request->subject_id)->get();
       
        foreach($subjects as $subject)
        {
            $class_room_id = $subject->class_room_id ;
        }
        $studants = DB::table('students')->where('class_room_id' , $class_room_id)->get();
        
        foreach($studants as $studant){
            
            attendance::create([
                'lecture_id' => $lectuer_id->id,
                'student_id' => $studant->id,
                'staute' => 'n',
            ]);
            // dd($data);
            // ($data);
        }
       
        
        return redirect(route('admin.lecture.index'));
    }

    // 
    public function AttendanceClass($id)
    {
        $subjects = DB::table('subjects')->where('class_room_id' , $id)->get();
        foreach($subjects as $subject)
        {
            $subject_id = $subject->id;
        }
        $attendance = attendance::all()->where('role','teacher')->count();
    //   dd($subjects);
        return view('lectures.attendance')->with('subjects' , $subjects)
        ->with('attendance',$attendance);
    }

    public function AttendanceSubject($id)
    {
        $subjects = DB::table('subjects')->select('id')->where('id' , $id)->get();
    //   dd($subjects);
        return view('lectures.attendance_subjects')->with('subjects' , $subjects);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subjects = DB::table('lectures')->select('subject_id')->where('id',$id)->get()->first();
        foreach ($subjects as $subject)
        {
            $subject_id = $subject ;
        }
        $teachers = DB::table('subjects')->select('teacher_id')->where('id',$subject_id)->get()->first();
        foreach ($teachers as $teacher)
        {
            $teacher_id = $teacher ;
        }
        return view('lectures.show')->with('lectures',lectures::all()->where('id',$id))->
        with('contents',content::all()->where('lecture_id',$id)
        ->where('type','video'))->with('teachers' ,teachers::all()->where('id',$teacher_id));
    }
    /** 
     * display lecture to student
    */
    
     public function ShowStudent($id)
    {
        return view('lectures.index')->with('lectures',lectures::all()->where('id',$id))->
        with('contents',content::all()->where('lecture_id',$id)->where('type','video'))
        ->with('chat_leactures' , chat_leacture::all()->where('lecture_id' ,$id));
    
    }


    // @return \Illuminate\Http\Response
    function getVideo($video_id){

        $path = storage_path('app/public/content/video/'.$video_id);

        if (!File::exists($path)) {
            abort(404);
        }

        $stream = new $path;

        return response()->stream(function() use ($stream) {
            $stream->start();
        });
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
