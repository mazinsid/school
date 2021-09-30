<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class content extends Model
{
    use HasFactory;
    protected $fillable = ['type','file','lecture_id'];

    public function lectures()
    {
        return $this->belongsTo(lectures::class);
    }
}  
