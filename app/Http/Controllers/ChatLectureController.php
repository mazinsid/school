<?php

namespace App\Http\Controllers;

use App\Models\chat_leacture;
use Carbon\Carbon;
use DateTime;
use Facade\FlareClient\Time\SystemTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatLectureController extends Controller
{
    
    public function StudentMessage(Request $request)
    {
        $dt = Carbon::now();
          
       chat_leacture::create([
            'lecture_id' => $request->lecture_id,
            'user_id' => $request->student_id,
            'message' => $request->message,
            'message_time' => $dt->toTimeString(),
        ]);
        return view('lectures.studantComment')->
        with('chat_leactures' , chat_leacture::all()->where('lecture_id' ,$request->lecture_id));
    

    }


  
}
