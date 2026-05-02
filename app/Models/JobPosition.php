<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use Translatable;

    protected $fillable = [
        'title_en', 'title_ar',
        'department_en', 'department_ar',
        'location_en', 'location_ar',
        'type',
        'description_en', 'description_ar',
        'requirements_en', 'requirements_ar',
        'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function scopeActive($q)  { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('sort_order')->orderBy('id'); }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'full-time'  => 'Full-time',
            'part-time'  => 'Part-time',
            'remote'     => 'Remote',
            'hybrid'     => 'Hybrid',
            'internship' => 'Internship',
            'contract'   => 'Contract',
            default      => $this->type,
        };
    }

    public function getTypeColorAttribute(): string
    {
        return match($this->type) {
            'full-time'  => 'rgba(40,200,100,',
            'remote'     => 'rgba(80,200,255,',
            'hybrid'     => 'rgba(200,150,255,',
            'part-time'  => 'rgba(255,200,80,',
            'internship' => 'rgba(255,150,80,',
            'contract'   => 'rgba(200,200,200,',
            default      => 'rgba(245,168,0,',
        };
    }
}
