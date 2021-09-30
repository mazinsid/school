<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class homework_answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'homework_id',
        'student_id',
        'answers',
    ];


    public function homework()
    {
        return $this->belongsTo(homework::class);
    }

    public function student()
    {
        return $this->belongsTo(students::class);
    }
}
