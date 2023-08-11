<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'question_id',
        'option_text',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
