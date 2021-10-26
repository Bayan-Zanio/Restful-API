<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','seasons_name','details','subject_name','homework_goal','duration','materiales',
    ];

    public function claas()
    {
        return $this->belongsTo(Claas::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function images()
    {
        return $this->hasMany(Images::class,);
    }

    

    public function deliveries()
    {
        return $this->belongsTo(Deliveries::class);
    }
}
