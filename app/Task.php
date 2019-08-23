<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'is_complete' => 'boolean',
    ];
    
    protected $fillable = [
        'title',
        'is_complete',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeBusqueda($query, $busqueda){
        if($busqueda)
            return $query->where('title', 'LIKE', "%$busqueda%");
    }

    public function scopeUser($query, $user){
        if($user)
            return $query->where('user_id', 'LIKE', "$user");
    }
}
