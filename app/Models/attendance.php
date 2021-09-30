<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'lecture_id',
        'student_id',
        'staute',
        
    ];

    public function lecture()
    {
        return $this->belongsTo(lectures::class);
    }

    public function student()
    {
        return $this->belongsTo(students::class );
    }
}
