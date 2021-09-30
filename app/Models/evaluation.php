<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'student_id',
        'evaluation',
        'note',
    ];
    
    public function student()
    {
        return $this->belongsTo(students::class,'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(subjects::class);
    }
}
