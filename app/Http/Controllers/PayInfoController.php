<?php

namespace App\Http\Controllers;

use App\Models\pay_info;
use App\Models\students;
use Illuminate\Http\Request;

class PayInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    }

    public function GetStudentPay($id)
    {
        return view('pay.GetStudentPay')->with('payInfos',pay_info::all()->where('student_id',$id));
    }
    // show admin student pay
    public function ShowPayStudent($id)
    {
        return view('pay.GetStudentPay')->with('payInfos',pay_info::all()
        ->where('student_id',$id));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        pay_info::create([
            'installment' => $request->installment ,
            'type_pay'=> $request->type_pay ,
            'notice_tranfer' => $request->notice_tranfer->store('images/pay','public'),
            'student_id'=> $request->student_id ,
            'amount'=> $request->amount ,

        ]);
        session()->flash('success', 'تم ادخل البانات بنجاح');
        
        return redirect(route('parent.students'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    public function PayStudent($id)
    {
        return view('pay.create')->with('students',students::all()->where('id',$id));
 

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
