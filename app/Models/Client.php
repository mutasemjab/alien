<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
   protected $fillable = ['name', 'logo', 'website_url', 'sort_order', 'is_active'];
   protected $casts    = ['is_active' => 'boolean'];

   public function scopeActive($q)
   {
      return $q->where('is_active', true);
   }
   public function scopeOrdered($q)
   {
      return $q->orderBy('sort_order');
   }

   public function getLogoUrlAttribute(): string
   {
      return $this->logo
         ? asset('assets/admin/uploads/' . $this->logo)
         : null;
   }
}
