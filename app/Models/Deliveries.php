<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id','Notes','status','homework_id',
    ];

    public function claas()
    {
        return $this->hasMany(Claas::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class,'deliveries_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homework()
    {
        return $this->hasMany(Homework::class);
    }
}
