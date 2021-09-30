<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;
    protected $fillable = [

        'time_lec',
        'subject_id',
        'week_days',
        'number'
    ];

    public function subject()
    {
        return $this->belongsTo(subjects::class);
    }


}
