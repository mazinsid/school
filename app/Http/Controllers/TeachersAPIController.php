<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\lectures;
use App\Models\students;
use App\Models\teachers;
use App\Models\subjects;
use App\Models\homework;
use App\Models\evaluation;
use App\Models\chat_leacture;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class TeachersAPIController extends Controller
{
    public function TeacherSingInAPI(Request $request)
    {
        $users = DB::table('users')->where('name' , $request->user_name)->get();
        if($users->isNotEmpty()){
        foreach($users as $user)
        {
            $userpassword = $user->password;
            $userid = $user->id;
           
        }

        if(password_verify($request->passowrd, $userpassword)) {
            
            $teachers = teachers::all()->where('user_id',$userid);
           
        foreach( $teachers as $teacher) {
            $res = ([
                'token' => $teacher->user->remember_token,
                'user_id' => $teacher->user->id,
                'full_name' =>  $teacher->name ,
                'subject' =>  $teacher->subject ,
                'cv' => $teacher->cv ,
                'image' => $teacher->image ,

            ]) ;
        }
            return response()->json($res );
        }
        else
        {
            $error = "password not fount";
            return response()->json($error);
        }
    }else{
        $error = "user name not fount";
        return response()->json($error);
    }       

    }

    // LectuerDateAPI 
    public function TeacherLectuerDateAPI(Request $request)
    {
        $to_date = $request->to_date ;
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        if($users->isNotEmpty()){
        foreach($users as $user)
        {
            $user_id = $user->id;
        }
        
        $teachers = teachers::all()->where('user_id',$user_id);
           
        foreach( $teachers as $teacher) {
            $teacher_id = $teacher->id ;
        }
        $subjects = DB::table('subjects')->where('teacher_id' , $teacher_id)->pluck('id')->toArray();
        $lectures = DB::table('lectures')  
        ->join('subjects', 'lectures.subject_id', '=', 'subjects.id')
       ->select('lectures.id' ,'lectures.lectuer_date', 'subjects.name')
       ->whereIn('subject_id' , $subjects)->
       whereDate('lectuer_date' ,'=', $to_date)->get(); 

       
    
       return response()->json($lectures);
        }else{
        return 'token error';
    }
    }

    // TeacherLectuerContentAPI
    public function TeacherLectuerContentAPI(Request $request)
    {
        $users = User::all()->where('remember_token' , $request->token);
        $contents = DB::table('contents')->where('lecture_id' , $request->lecture_id)->get();
        // $messages = DB::table('chat_leactures')->where('lecture_id' ,$request->lecture_id)->get();
  
        if($users->isNotEmpty()){
            foreach($contents as $content){
                $LectureContent = [ 
                    'lecture'  => $content->lecture_id ,
                    'type' => $content->type ,
                    'file' => $content->file,
                ];

            }
        return response()->json($LectureContent)  ;
         }else{
             return 'token error';
         }
    }


    // Lecture Chat
    public function TeacherLectureChatAPI(Request $request)
    {

        $users = User::all()->where('remember_token' , $request->token);
        $messages = DB::table('chat_leactures')->where('lecture_id' ,$request->lecture_id)->get();
  
        // foreach($users as $user)
        // {
        //     $userpassword = $user->password;
        //     $userid = $user->id;
           
        // }
//         $data = [];
// for ($i = 0; $i < count($months); $i++) {
//     $data[] = [
//         'month' => $monts[$i],
//         'cashUniform' => $cashUniform[$i],
//         'cashFee' => $cashFee[$i],
//         'cashExpenses' => $cashExpenses[$i],
//     ];
// }
        if($users->isNotEmpty()){
            
        return response()->json($messages)  ;
         }else{
             return 'token error';
         }
    }


    // send Message Chat Lectuer

    public function TeacherLectuerMessageAPI(Request $request)
    {
        $users = User::all()->where('remember_token' , $request->token);
        $dt = Carbon::now();
        
        $messages = chat_leacture::create([
            'lecture_id' => $request->lecture_id,
            'user_id' => $request->sender_id,
            'message' => $request->massage_content,
            'message_time' => $dt->toTimeString(),
        ]);
        
        if($messages){
            return  response()->json(['status'=> 'okay']);
        }else{
           return  response()->json(['status'=>'filed']);
        }
    }


    // teacher subjects 
    public function TeacherSubjectsAPI(Request $request)
    {
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();

        if($users->isNotEmpty()){
        
        foreach($users as $user)
        {
            $user_id = $user->id;
        }
         
        $teachers = teachers::all()->where('user_id',$user_id);
           
        foreach( $teachers as $teacher) {
            $teacher_id = $teacher->id ;
        }
        $subjects = DB::table('subjects')->where('teacher_id' , $teacher_id)->get();
       
        return response()->json($subjects);
          }else{
             return 'token error';
         }
    }


    // EvaluationstudantListAPI
    public function EvaluationstudantListAPI(Request $request)
    {

        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();

        if($users->isNotEmpty()){
            $subjects = DB::table('subjects')->select('class_room_id')->where('id' , $request->subject_id)->get();
       
            foreach($subjects as $subject)
            {
                $class_room_id = $subject->class_room_id ;
            }
            $studants = DB::table('students')->where('class_room_id' , $class_room_id)->get();
            return response()->json($studants);
        }else{
             return 'token error';
         }

    }

    // evaluation list

    public function EvaluationSubjectAPI(Request $request)
    {

        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();

        if($users->isNotEmpty()){
            $evaluations = DB::table('evaluations')->where('subject_id' , $request->subject_id)->get();
       
            return response()->json($evaluations);
        }else{
             return 'token error';
         }

    }

    // Evaluation Add API

    public function EvaluationAddAPI(Request $request)
    {
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();

        if($users->isNotEmpty()){
            $evaluations = evaluation::create([
                'subject_id' => $request->subject_id,
                'student_id' => $request->student_id,
                'evaluation' => $request->evaluation,
                'note' => $request->note,
            ]);
            
            if($evaluations){
                return  response()->json(['status'=> 'ok']);
            }else{
               return  response()->json(['status'=>'filed']);
            }
        }else{
             return 'token error';
         }
    }

    // hom work 

    public function TeacherAddHomworkAPI(Request $request)
    {
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();

        if($users->isNotEmpty()){
            $evaluations = homework::create([
                'lectuer_id' => $request->lectuer_id,
                'linkwork' => $request->linkwork,
            ]);
            
            if($evaluations){
                return  response()->json(['status'=> 'ok']);
            }else{
               return  response()->json(['status'=>'filed']);
            }
        }else{
             return 'token error';
         }
    }

    // sing out 
    public function TeacherSingOutAPI(Request $request)
    {
        $users = DB::table('users')->where('remember_token' , $request->token)->get();
       
        $userss = User::all()->where('remember_token' , $request->token)->first();
      foreach($users as $user)
      {
          $user_name = $user->name;
      }
        if ($users->isNotEmpty()) {
            $userss->update([
                'remember_token' => $userss->createToken($user_name)->plainTextToken
              ]);
                return response()->json(["message" =>true ]);
        }else{
            return response()->json(["message" =>false]);    
        }
    
    }

}
