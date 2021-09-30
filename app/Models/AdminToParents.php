<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminToParents extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'parents_id',
        'title',
        'message',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class , 'parents_id');
    }
}
