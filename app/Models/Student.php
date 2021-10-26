<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','class_name','phone','address','date_of_birth','gender','image','email',
    ];

    public function claas()
    {
        return $this->belongsTo(Claas::class, 'class_name' , 'id')->withDefault();
        
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email' , 'id')->withDefault();
        
    }
}
