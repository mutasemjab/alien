<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge_text_en','badge_text_ar',
        'title_line1_en','title_line1_ar',
        'title_line2_en','title_line2_ar',
        'title_line3_en','title_line3_ar',
        'description_en','description_ar',
        'btn_primary_text_en','btn_primary_text_ar','btn_primary_url',
        'btn_secondary_text_en','btn_secondary_text_ar','btn_secondary_url',
        'stat_projects','stat_years','stat_engineers','stat_satisfaction',
        'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    /** Return the single active hero row (or first) */
    public static function active(): self
    {
        return static::where('is_active', true)->firstOrNew([]);
    }

    /** Get translated field */
    public function trans(string $field): string
    {
        $locale = app()->getLocale();
        $key    = $field . '_' . $locale;
        return $this->$key ?? $this->{$field . '_en'} ?? '';
    }
}
