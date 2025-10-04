<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'message',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
