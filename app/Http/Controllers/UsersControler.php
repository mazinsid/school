<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class UsersControler extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        'role' =>  $request->role,
        'state' => $request->state,
        'parent_id' => $request->parent_id,
        'email_verified_at' => now(),
       
        
    ]);
   
    $user->update([
      'remember_token' => $user->createToken($request->name)->plainTextToken
    ]);
    
    $id = user::latest('id')->first();
    return redirect(route('student.info',$id));

    } 
      public function storeTeacher(Request $request)
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
        'role' =>  'teacher',
        'state' => 'active',
        'parent_id' => 0,
        'email_verified_at' => now(),
       
    ]);
    $user->update([
      'remember_token' => $user->createToken($request->name)->plainTextToken
    ]);
    $id = user::latest('id')->first();
    
     return redirect(route('admin.teacher.insert',$id));
    }

}
