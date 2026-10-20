<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   use Translatable;

   protected $fillable = [
      'icon',
      'title_en',
      'title_ar',
      'description_en',
      'description_ar',
      'tags',
      'sort_order',
      'is_active',
      'slug',
      'body_en',
      'body_ar',
      'meta_title_en',
      'meta_title_ar',
      'meta_desc_en',
      'meta_desc_ar',
   ];
   protected $casts = ['tags' => 'array', 'is_active' => 'boolean'];

   public function scopeActive($q)   { return $q->where('is_active', true); }
   public function scopeOrdered($q)  { return $q->orderBy('sort_order'); }
   public function scopeHasDetail($q){ return $q->whereNotNull('slug'); }

   public function getHasDetailAttribute(): bool
   {
      return ! empty($this->slug);
   }

   public static function generateSlug(string $title): string
   {
      $base  = \Illuminate\Support\Str::slug($title);
      $count = static::where('slug', 'like', "$base%")->count();
      return $count ? "$base-$count" : $base;
   }
}
