<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;
    protected $fillable = ['full_name','brith' , 'address' , 'class_room_id', 
    'last_result', 'birth_certificate', 'id_number', 'image', 'user_id', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Parents::class , 'parent_id');
    }
    public function class_room()
    {
        return $this->belongsTo(class_room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pay_info()
    {
        return $this->hasMany(pay_info::class);
    }

    public function evaluation()
    {
        return $this->hasMany(evaluation::class);
    }
    
}
