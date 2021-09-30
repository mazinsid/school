<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'state',
        'parent_id',
        'remember_token',
        'device_token',
    ];

    public function teachers()
    {
        return $this->hasMany(teachers::class);
    }
    public function students()
    {
        return $this->hasOne(students::class);
    }
    public function chat_lectures()
    {
        return $this->hasMany(chat_leacture::class);
    }

    public function parent_message()
    {
        return $this->hasMany(parent_message::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function IsٍStudent(){
        return $this->role == 'studant';
    }
    public function IsٍTeacher(){
        return $this->role == 'teacher';
    }  
     public function IsٍParent(){
        return $this->role == 'parents';
    }
    public function IsٍActive(){
        return $this->state == 'active';
    }
}
