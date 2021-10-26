<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    use HasFactory;

    protected $fillable=[
        'evaluation','user_id','personal_cleanliness','punctuality','homework','share','notes','teacher_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
