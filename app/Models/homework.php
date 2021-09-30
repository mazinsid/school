<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class homework extends Model
{
    use HasFactory;

    protected $fillable = [
        'lectuer_id',
        'linkwork',
    ];

    public function lectuer()
    {
        return $this->belongsTo(lectures::class , 'lectuer_id');
    }

    public function homework_answer()
    {
        return $this->hasMany(homework_answer::class);
    }
}
