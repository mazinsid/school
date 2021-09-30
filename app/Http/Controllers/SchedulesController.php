<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\class_room;
use App\Models\homework;
use App\Models\lectures;
use App\Models\schedule;
use App\Models\students;
use App\Models\subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('schedule.index')
        ->with('ClassRooms',class_room::all())->
        with('subjects' , subjects::all())
        ->with('schedulesSun',schedule::all()->where('week_days','السبت'))
        ->with('schedulesMon',schedule::all()->where('week_days','الاحد'))
        ->with('schedulesTue',schedule::all()->where('week_days','الاثنين'))
        ->with('schedulesWed',schedule::all()->where('week_days','الثالثاء'))
        ->with('schedulesThu',schedule::all()->where('week_days','الاربعاء'))
        ->with('schedulesFri',schedule::all()->where('week_days','الخميس'));
    }

    // get schedule where class room
    public function getScheduleClass($class_room_id)
    {
        $subjects = DB::table('subjects')->select('id')
        ->where('class_room_id' ,$class_room_id)->get();

        foreach($subjects as $subject)
        {
            $subject_id[] = $subject->id;
        }
    //    $schedule= schedule::all()->where('week_days','الاحد')->whereIn('subject_id', $subject_id);
    //     dd($schedule);

       return view('schedule.schelduleClass')
        ->with('ClassRooms',class_room::all()->where('id',$class_room_id))->
        with('subjects' , subjects::all())
        ->with('schedulesSun',schedule::all()->where('week_days','السبت')->whereIn('subject_id', $subject_id))
        ->with('schedulesMon',schedule::all()->where('week_days','الاحد')->whereIn('subject_id', $subject_id))
        ->with('schedulesTue',schedule::all()->where('week_days','الاثنين')->whereIn('subject_id', $subject_id))
        ->with('schedulesWed',schedule::all()->where('week_days','الثالثاء')->whereIn('subject_id', $subject_id))
        ->with('schedulesThu',schedule::all()->where('week_days','الاربعاء')->whereIn('subject_id', $subject_id))
        ->with('schedulesFri',schedule::all()->where('week_days','الخميس')->whereIn('subject_id', $subject_id));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule.create')->with('subjects',subjects::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        schedule::create([
            'time_lec'=> $request->time_lec ,
            'subject_id'=> $request->subject_id ,
            'week_days'=> $request->week_days ,
            'number'=> $request->number ,
            ]);

            return redirect(route('admin.schedule.index'));
        }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ScheduleStudent()
    {
        $iduser = Auth::user()->id;
        $class_room = DB::table('students')->where('user_id',$iduser)->value('class_room_id'); 
        
        $subjects = subjects::where('class_room_id',$class_room)->get('id');
        
        
       return view('schedule.ScheduleStudent')
       ->with('schedules',schedule::whereIn('subject_id',$subjects)->get());
    }
    public function ScheduleDay()
    {
        $iduser = Auth::user()->id;
        $class_room = DB::table('students')->where('user_id',$iduser)->value('class_room_id'); 
        
        $subjects = subjects::where('class_room_id',$class_room)->get('id');
        
        $lectures = lectures::whereIn('subject_id',$subjects)->get();
       
        // $homeworks = homework::whereIn('lectures_id',$lectures)->get();
        return view('schedule.ScheduleDay')->with('lectures', $lectures);
    }
    public function show($id)
    {
        $subjects = subjects::all()->where('class_room_id',$id);
        foreach($subjects as $subject)
        {
            
        }
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
    public function update(Request $request, schedule $schedule)
    {
        $schedule->update([
            'time_lec'=> $request->time_lec ,
            'subject_id'=> $request->subject_id ,
            'week_days'=> $request->week_days ,
            'number'=> $request->number ,
            ]);

            return redirect(route('admin.schedule.index'));
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
