<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pay_info extends Model
{
    use HasFactory;
    protected $fillable = [
        'installment',
        'type_pay',
        'notice_tranfer',
        'amount',
        'student_id',
        
    ];

    public function student(){
        return $this->belongsTo(students::class);
    }
}
