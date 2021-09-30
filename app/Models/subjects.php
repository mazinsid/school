<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjects extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'class_room_id','teacher_id'];

    public function lectures()
    {
        return $this->hasMany(lectures::class);
    }
    public function class_room()
    {
        return $this->belongsTo(class_room::class);
    }
    public function teacher()
    {
        return $this->belongsTo(teachers::class);
    }
    public function schedule()
    {
        return $this->hasMany(schedule::class);
    }
    public function evaluation()
    {
        return $this->hasMany(evaluation::class);
    }

}
