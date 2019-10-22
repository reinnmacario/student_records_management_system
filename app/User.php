<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Role;
use App\Organization;
use App\OSA;
use App\SOCC;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'first_name', 'last_name', 'updated_at', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "users";

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relationships 
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, 'user_id', 'id');
    }

    public function socc()
    {
        return $this->hasOne(SOCC::class, 'user_id', 'id');
    }

    public function osa()
    {
        return $this->hasOne(OSA::class, 'user_id', 'id');
    }
}
