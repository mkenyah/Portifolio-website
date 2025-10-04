<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $fillable = [
        'project_id',
        'rating',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
