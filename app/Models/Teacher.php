<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','seasons_name','phone','address','date_of_birth','gender','image','email',
    ];

    public function claas()
    {
        return $this->belongsTo(Claas::class, 'seasons_name' , 'id')->withDefault();
        
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email' , 'id')->withDefault();
        
    }
    
    public function getImageUrlAttribute()
    {
        if($this->image)
        {
            if(strpos($this->image,'http') ===0)
            {
                return $this->image;
            }
            return asset('uploads/' . $this->image);
            //return Storage::disk('uploads')->url($this->image);
        }


    }
}
