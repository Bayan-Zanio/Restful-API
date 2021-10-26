<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
     ];


     public function homework()
     {
         return $this->hasMany(Homework::class);
     }

     public function user()
     {
        return $this->belongsToMany(User::class);
     }
}
