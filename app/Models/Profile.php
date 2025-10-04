<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'bio',
        'email',
        'phone',
        'location',
        'profile_picture',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
