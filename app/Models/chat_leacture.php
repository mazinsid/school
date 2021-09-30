<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat_leacture extends Model
{
    use HasFactory;
    protected $fillable = [
        'lecture_id',
        'user_id',
        'message',
        'message_time',
        
    ];

    public function lecture(){
        return $this->belongsTo(lectures::class , 'lecture_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
