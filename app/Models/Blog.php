<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use Translatable;

    protected $fillable = [
        'slug', 'title_en', 'title_ar', 'excerpt_en', 'excerpt_ar',
        'body_en', 'body_ar', 'image', 'category_en', 'category_ar',
        'tags', 'author', 'meta_title_en', 'meta_title_ar',
        'meta_desc_en', 'meta_desc_ar', 'is_active', 'published_at', 'sort_order',
    ];

    protected $casts = [
        'tags'         => 'array',
        'is_active'    => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopeActive($q)   { return $q->where('is_active', true); }
    public function scopePublished($q){ return $q->where('published_at', '<=', now()); }
    public function scopeOrdered($q)  { return $q->orderByDesc('published_at'); }

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('assets/admin/uploads/' . $this->image)
            : asset('images/og-default.jpg');
    }

    public function getReadingTimeAttribute(): int
    {
        $text = strip_tags(($this->body_en ?? '') . ' ' . ($this->body_ar ?? ''));
        return max(1, (int) ceil(str_word_count($text) / 200));
    }

    public static function generateSlug(string $title): string
    {
        $base  = Str::slug($title);
        $count = static::where('slug', 'like', "$base%")->count();
        return $count ? "$base-$count" : $base;
    }
}
