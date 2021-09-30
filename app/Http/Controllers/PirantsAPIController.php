<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Parents;
use App\Models\parent_message;
use App\Models\students;
class PirantsAPIController extends Controller
{
    // pirants sing up 
    
    public function SingUpAPI(Request $request)
    {
        $request->validate( [
            'name' => ['required', 'string', 'max:255',
                Rule::unique(User::class),],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ]]);
    
       $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' =>  'parents',
            'state' => 'active',
            'parent_id' => 0,
            'email_verified_at' => now(),
           
            
        ]);
       
        $user->update([
          'remember_token' => $user->createToken($request->name)->plainTextToken
        ]);

        // $user->update([
        //     'device_token' => $request->fcm_token
        // ]);

        $id = $user->id ;

        Parents::create([
            'name' => $request->full_name ,
            'phone' => $request->phone ,
            'user_id' => $id ,
      
        ]);

        $parents = Parents::all()->where('user_id',$id);
           
        foreach( $parents as $parent) {
        $res = ([
            'id' => $parent->id,
            'full_name' => $parent->name,
            'phone' => $parent->phone,
            'user_id' => $parent->user_id,
            'user_name' => $parent->user->name,
            'email' => $parent->user->email,
            'state' => $parent->user->state,
            'remember_token' => $parent->user->remember_token,
        ]);
        }
        return response()->json($res);
    }

    // pirant sing api 

    public function PirantSingInAPI(Request $request)
    {
        $users = DB::table('users')->where('name' , $request->user_name)->get();
        if($users->isNotEmpty()){
        foreach($users as $user)
        {
            $userpassword = $user->password;
            $userid = $user->id;
           
        }

        if(password_verify($request->passowrd, $userpassword)) {
            
            $parents = Parents::all()->where('user_id',$userid);
           
        foreach( $parents as $parent) {
        $res = ([
            
            'full_name' => $parent->name,
            'phone' => $parent->phone,
            'user_id' => $parent->user_id,
            'user_name' => $parent->user->name,
            'email' => $parent->user->email,
            'state' => $parent->user->state,
            'remember_token' => $parent->user->remember_token,
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

    // pirants Lest of teachers

    public function PirantTeachersLestAPI(Request $request)
    {
        $users = User::all()->where('remember_token' , $request->token);
        $techers = DB::table('teachers')->get();
        if($users->isNotEmpty()){
   
        return response()->json($techers);
         }
    }

    // priant sent MEssages to admin
    public function PirantSentMessagesAPI(Request $request)
    {
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        foreach($users as $user)
        {
            $user_id = $user->id;
        }
        
            $messages = parent_message::create([
            'user_id' => $user_id,
            'message' => $request->massage,
            
        ]);
        
        if($messages){
            return  response()->json(['status'=> 'okay']);
        }else{
           return  response()->json(['status'=>'filed']);
        }
    }

    // get message to pirant
    public function PirantGetMessagesAPI(Request $request)
    {
        $user_id = 0;
        $users = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        if($users->isNotEmpty()){
        foreach($users as $user)
        {
            $user_id = $user->id;
        }
        $messages = DB::table('parent_messages')->where('user_id' ,$user_id)->get();
    
        return response()->json($messages)  ;
         }else{
             return 'token error';
         }
    }

    // add studant 

    public function AddStudantAPI(Request $request)
    {
        $parents = DB::table('users')->select('id')->where('remember_token' , $request->token)->get();
        foreach($parents as $parent)
        {
            $parentuser_id = $parent->id;
        }
        $user =  User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' =>  'studant',
            'state' => 'Inactive',
            'parent_id' => $parentuser_id,
            'email_verified_at' => now(),         
        ]);
       
        $user->update([
          'remember_token' => $user->createToken($request->user_name)->plainTextToken
        ]);
        
        $id = $user->id;
    
        students::create([
            'full_name' => $request->full_name ,
            'brith'=> $request->brith ,
            'address'=> $request->address ,
            'class_room_id'=> $request->class_room_id ,
            'last_result' => $request->last_result->store('result','public'),
            'birth_certificate' => $request->birth_certificate->store('birth','public'),
            'id_number' => $request->id_number->store('idnumber','public'),
            'image' => $request->image->store('images/studends','public'),
            'user_id'=> $id ,
            'parent_id'=> $parentuser_id 
        ]);
        return response()->json(["message" =>true ]);
        // eddit apis
    }



    // Studant Pirant
    public function PirantStudantsAPI(Request $request)
    {

        $users = DB::table('users')->where('remember_token' , $request->token)->get();
   
      foreach($users as $user)
      {
          $user_id = $user->id;
      }
      if ($users->isNotEmpty()) {

        $students = DB::table('students')->where('parent_id' ,$user_id)->get();
    
        return response()->json($students)  ;
         }else{
             return 'token error';
      }
    }

    // Evaluations studant API
    public function EvaluationsAPI(Request $request)
    {
        $users = DB::table('users')->where('remember_token' , $request->token)->get();
        if ($users->isNotEmpty()) {
            $evaluations = DB::table('evaluations')->where('student_id' ,$request->student_id)->get();
            foreach($evaluations as $evaluation)
            {
                $date = $evaluation;
            }
            return response()->json($date)  ;
         }else{
             return 'token error';
      }
    }

    // news 
    public function PirantNewsAPI(Request $request)
    {
        $users = DB::table('users')->where('remember_token' , $request->token)->get();
        if ($users->isNotEmpty()) {
            $news = DB::table('news')->get();
            return response()->json($news)  ;
         }else{
             return 'token error';
      }
    }
    // sing out 

    public function PirantSingOutAPI(Request $request)
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
