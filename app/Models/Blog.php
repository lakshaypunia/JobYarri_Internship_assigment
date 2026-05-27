<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'content',
        'image',
        'category_id',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
