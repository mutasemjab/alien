<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_position_id', 'full_name', 'email', 'phone',
        'position', 'hear_about_us', 'cover_letter',
        'resume', 'status', 'notes',
    ];

    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class);
    }

    public function getResumeUrlAttribute(): ?string
    {
        return $this->resume
            ? asset('assets/admin/uploads/resumes/' . $this->resume)
            : null;
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new'         => '🆕 New',
            'reviewing'   => '👁 Reviewing',
            'shortlisted' => '⭐ Shortlisted',
            'rejected'    => '❌ Rejected',
            'hired'       => '✅ Hired',
            default       => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new'         => '#6366f1',
            'reviewing'   => '#f5a800',
            'shortlisted' => '#22c55e',
            'rejected'    => '#ef4444',
            'hired'       => '#10b981',
            default       => '#8a7ab8',
        };
    }
}
