<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
   use Translatable;

   protected $fillable = [
      'title_en',
      'title_ar',
      'description_en',
      'description_ar',
      'image',
      'category_en',
      'category_ar',
      'tags',
      'project_url',
      'github_url',
      'sort_order',
      'is_active',
   ];
   protected $casts = ['tags' => 'array', 'is_active' => 'boolean'];

   public function scopeActive($q)
   {
      return $q->where('is_active', true);
   }
   public function scopeOrdered($q)
   {
      return $q->orderBy('sort_order');
   }

   public function getImageUrlAttribute(): string
   {
      return $this->image
         ? asset('assets/admin/uploads/' . $this->image)
         : asset('images/placeholder.png');
   }
}
