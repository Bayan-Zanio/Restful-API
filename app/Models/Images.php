<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable=['homework_id','activities_id','evaluations_id','deliveries_id','image_path'];

    public function homework()
    {
        return $this->belongsTo(Homework::class,);
    }
    

    public function activities()
    {
        return $this->belongsTo(Activities::class,'activities_id','id');
    }

    public function deliveries()
    {
        return $this->belongsTo(Deliveries::class,'deliveries_id','id');
    }
}
