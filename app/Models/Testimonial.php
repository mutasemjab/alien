<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
   use Translatable;

   protected $fillable = [
      'author_name_en',
      'author_name_ar',
      'author_role_en',
      'author_role_ar',
      'author_company',
      'avatar',
      'quote_en',
      'quote_ar',
      'rating',
      'sort_order',
      'is_active',
   ];
   protected $casts = ['is_active' => 'boolean'];

   public function scopeActive($q)
   {
      return $q->where('is_active', true);
   }
   public function scopeOrdered($q)
   {
      return $q->orderBy('sort_order');
   }

   /** Initials from English name for avatar fallback */
   public function getInitialsAttribute(): string
   {
      $parts = explode(' ', $this->author_name_en);
      return strtoupper(
         substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1)
      );
   }
}
