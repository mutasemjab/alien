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
}
