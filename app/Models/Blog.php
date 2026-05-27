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

    protected $appends = ['image_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Returns a fully-qualified URL whether the image is an
    // UploadThing CDN link or a legacy local storage path.
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
