<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
   use Translatable;

   protected $fillable = [
      'city_en',
      'city_ar',
      'country_en',
      'country_ar',
      'flag_emoji',
      'label_en',
      'label_ar',
      'address_en',
      'address_ar',
      'phone',
      'email',
      'working_hours_en',
      'working_hours_ar',
      'latitude',
      'longitude',
      'is_active',
      'sort_order',
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
}
