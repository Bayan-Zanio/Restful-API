<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','seasons_name','activities_goal','details','duration',
    ];

    public function claas()
    {
        return $this->belongsTo(Claas::class,'seasons_name', 'id')->withDefault();;
    }

    public function images()
    {
        return $this->hasMany(Images::class,'activities_id','id');
    }
}
