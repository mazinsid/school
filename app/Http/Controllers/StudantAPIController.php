<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\schedule;
use App\Models\students;
use App\Models\subjects;
use App\Models\attendance;
use App\Models\chat_leacture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
class StudantAPIController extends Controller
{
    public function StudantInfoAPI(Request $request)
    {
        $users = DB::table('users')->where('name' , $request->user_name)->get();
        if($users->isNotEmpty()){
        foreach($users as $user)
        {
            $userpassword = $user->password;
            $userid = $user->id;
           
        }
       $usersss = User::all()->where('id' , $userid);
       foreach($usersss as $userss)
       {
           $update_user = $userss ;
       }
        $update_user->update([
            'device_token' => $request->fcm_token
        ]);

        if(password_verify($request->passowrd, $userpassword)) {
            
            $studants = students::all()->where('user_id',$userid);
           
            foreach( $studants as $studant) {
            $res = ([
                'id' => $studant->id,
                'full_name' => $studant->full_name,
                'address' => $studant->address,
                'class_room_id' => $studant->class_room_id,
                'class_room_name' => $studant->class_room->name,
                'id_number' => $studant->id_number,
                'last_result' => $studant->last_result,
                'image' => $studant->image,
                'user_id' => $studant->user_id,
                'parent_id' => $studant->parent_id,
                
                'user_name' => $studant->user->name,
                'email' => $studant->user->email,
                'state' => $studant->user->state,
                'remember_token' => $studant->user->remember_token,
            ]);
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


    public function TeachersLestAPI(Request $request)
    {
        $users = User::all()->where('remember_token' , $request->token);
        $techers = DB::table('teachers')->get();
        if($users->isNotEmpty()){
        
        return response()->json($techers);
         }
    }

    public function SubjectsAPI(Request $request)
    {
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        foreach($users as $user)
        {
            $user_id = $user->id;
        }
        $students = DB::table('students')->select('class_room_id')->where('user_id' , $user_id)->get();

        foreach($students as $students)
        {
            $class_room_id = $students->class_room_id;
        }
        $subjects = DB::table('subjects')->where('class_room_id' , $class_room_id)->get();
       
        if($users->isNotEmpty()){
        
        return response()->json($subjects);
         }
    }
    public function LectureAPI(Request $request)
    {
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        $lectures = DB::table('lectures')->where('subject_id' , $request->subject_id)->get();
  
        if($users->isNotEmpty()){
     
        return response()->json($lectures);
         }
    }
    // Lectuer Date 
    public function LectuerDateAPI(Request $request)
    {
        $to_date = $request->to_date ;
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        foreach($users as $user)
        {
            $user_id = $user->id;
        }
        $students = DB::table('students')->select('class_room_id')->where('user_id' , $user_id)->get();

        foreach($students as $students)
        {
            $class_room_id = $students->class_room_id;
        }
        $subjects = DB::table('subjects')->where('class_room_id' , $class_room_id)->pluck('id')->toArray();
    
        
        $lectures = DB::table('lectures')  
         ->join('subjects', 'lectures.subject_id', '=', 'subjects.id')
        ->select('lectures.id' ,'lectures.lectuer_date', 'subjects.name')
        ->whereIn('subject_id' , $subjects)->
        whereDate('lectuer_date' ,'=', $to_date)->get(); 

        if($users->isNotEmpty()){
     
        return response()->json($lectures);
    }else{
        return 'token error';
    }
    }

    // lectuer content api fo studant app
    public function LectureContentAPI(Request $request)
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
            foreach($users as $users)
            {
                
            }
            attendance::create([
                'lecture_id',
                'student_id',
                'staute',
            ]);
        return response()->json($LectureContent)  ;
         }else{
             return 'token error';
         }
    }

    public function LectureChatAPI(Request $request)
    {
        $users = User::all()->where('remember_token' , $request->token);
        $messages = DB::table('chat_leactures')->where('lecture_id' ,$request->lecture_id)->get();
  
        foreach($users as $user)
        {
            $userpassword = $user->password;
            $userid = $user->id;
           
        }
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
    
    // studant send message in lectuer API
    public function MessageLectuerAPI(Request $request)
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

    public function HomeworkAPI(Request $request)
    {
        $users = User::all()->where('remember_token' , $request->token);
        $homeworks = DB::table('homework')->where('lectuer_id' , $request->lecture_id)->get();

        foreach($homeworks as $homework)
        {
            $res = $homework;
        }

        if($users->isNotEmpty()){
     
        return response()->json($res);
         }
    }

    
    // schedul api for studat app
    public function ScheduleAPI(Request $request)
    {
        $week_day = $request->week_day;
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        if($users->isNotEmpty()){
        foreach($users as $user)
        {
            $user_id = $user->id;
        }
        $students = DB::table('students')->select('class_room_id')->where('user_id' , $user_id)->get();

        foreach($students as $students)
        {
            $class_room_id = $students->class_room_id;
         
        }
        $subjects = DB::table('subjects')->where('class_room_id' , $class_room_id)->pluck('id')->toArray();
    
         
           $schedules = DB::table('schedules')
           ->join('subjects', 'schedules.subject_id', '=', 'subjects.id')
           ->select('schedules.subject_id', 'subjects.name')
           ->whereIn('subject_id' , $subjects)->get(); 
           return response()->json($schedules);

     
    
         }else{
            return response()->json('user toke error');
         }
    }
  
    public function LogoutAPI(Request $request)
    {
        // $request->user()->token()->revoke();
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
