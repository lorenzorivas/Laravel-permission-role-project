<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $casts = [
        'published' => 'boolean',
    ];
    
    protected $fillable = [
        'title',
        'excerpt',
        'picture',
        'published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
