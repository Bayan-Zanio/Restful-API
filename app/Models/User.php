<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'image',
        'seasons_name',
        'address',
        'gender',
        'phone',
        'date_of_birth',
        'material',
        'materiales',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'image_url',
    ];

    protected static function booted()
    {
        static::saving(function (User $user) {
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });
    }

    /* public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
     }*/

    public function claas()
    {
        return $this->belongsToMany(Claas::class);
    }

    public function userdevice()
    {
        return $this->hasMany(UserDevice::class, 'user_id', 'id')->withDefault();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluations::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Deliveries::class,);
    }
    

    public function message()
    {
        return $this->hasMany(Messages::class, 'user_id', 'id')->withDefault();
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            if (strpos($this->image, 'http') === 0) {
                return $this->image;
            }
            return asset('uploads/' . $this->image);
            //return Storage::disk('uploads')->url($this->image);
        }
        return $this->image;
    }
}
