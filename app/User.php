<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image',
    ];

    protected static $logName = 'User Activitylog';
    protected static $logAttributes = ['name', 'email', 'profile_image'];

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

    public function scopeBusqueda($query, $busqueda){
        if($busqueda)
            return $query->where('name', 'LIKE', "%$busqueda%")
                         ->orWhere('email', 'LIKE', "%$busqueda%");
    }

    public function getImageAttribute()
    {
       return $this->profile_image;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
