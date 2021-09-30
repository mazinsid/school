<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lectures extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject_id',
        'number',
        'lectuer_date',
    ];

    public function subject()
    {
        return $this->belongsTo(subjects::class , 'subject_id');
    }

    public function schedule()
    {
        return $this->hasOne(schedule::class);
    }

    public function content(){
        return $this->hasMany(content::class);
    }

    public function homeworks()
    {
        return $this->hasMany(homework::class);
    }
    public function chat_lectures()
    {
        return $this->hasMany(chat_leacture::class);
    }
}
