<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','user_id','subject','rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'id')->withDefault();
        
    }
}
