<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claas extends Model
{
    use HasFactory;

    protected $fillable=[
        'seasons_name',
     ];
 
 
     //protected $casts=['seasons_name'=>'array'];

     public function homework()
     {
         return $this->hasMany(Homework::class);
     }
 
     public function user()
     {
        return $this->belongsToMany( User::class);
     }

     public function activities()
     {
         return $this->hasMany(Activities::class, 'seasons_name' , 'id')->withDefault();
     }

     public function deliveries()
    {
        return $this->hasMany(Deliveries::class);
    }
    
}
