<?php

namespace App\Http\Controllers;

use App\Models\AdminToParents;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\class_room;
use App\Models\evaluation;
use App\Models\parent_message;
use App\Models\students;
use App\Models\pay_info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminContorller extends Controller
{
    public function home()
    {

        $amounts = pay_info::select('amount')->get();
        $total = 0;
        foreach($amounts as $amount)
        {
            $total = $total + $amount->amount;
        }
        return view('home')->with('classRooms',class_room::all())
        ->with('studants' , students::all())
        ->with('studantsCount',students::count())
        ->with('teacherCount' , User::all()->where('role','teacher')->count())
        ->with('total' , $total)
        ->with('unactive' , User::all()->where('state','Inactive')->count());
    }

    public function UserHome()
    {
        $user_id = Auth::user()->id ;
        
        if(Auth::user()->role=='parents')
        {
            $students = DB::table('students')->select('id')->where('parent_id' ,$user_id)->get();
            $studant_count = 0;
            foreach($students as $student)
            {
                $student_id = $student->id;
                $studant_count++;
            }
            $amounts = pay_info::select('id','amount')->whereIn('student_id' , $students);
            $amount_pay = 0;
            $pay_number=0;
            foreach($amounts as $amount)
            {
                $pay_number++;
                $amount_pay = $amount_pay + $amount->amount;
            }
            // dd($amount_pay);
            $messages = AdminToParents::all()->where('parents_id',$user_id)->count();
            return view('home')->with('amount',$amount_pay)->with('studant_count',$studant_count)
            ->with('pay_number',$pay_number)->
            with('evaluations',evaluation::all()->whereIn('student_id',$students))
            ->with('messages' ,$messages);
        }else
        {
            return view('home');
        }
    }



}