<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'news_content',
        'author_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
