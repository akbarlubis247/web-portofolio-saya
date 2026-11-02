<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioSetting extends Model
{
    protected $fillable = [
        'name',
        'avatar_path',
        'title',
        'tagline',
        'about_bio',
        'career_goal',
        'email',
        'whatsapp',
        'linkedin',
        'github',
        'skills',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
        ];
    }

    public function getAvatarUrlAttribute(): ?string
    {
        if (! $this->avatar_path) {
            return null;
        }

        return str_starts_with($this->avatar_path, 'http://') || str_starts_with($this->avatar_path, 'https://')
            ? $this->avatar_path
            : asset('storage/'.$this->avatar_path);
    }

    public static function current(): self
    {
        return static::firstOrCreate([], [
            'name' => 'Your Name',
            'title' => 'Data Analyst',
            'tagline' => 'Passionate about data, insights, and visualization',
            'about_bio' => 'Mahasiswa Teknologi Rekayasa Perangkat Lunak (TRPL) dengan minat kuat di bidang analisis data.',
            'career_goal' => 'Menjadi Data Analyst profesional yang mampu mengubah data menjadi insight bisnis yang actionable.',
            'email' => 'email@example.com',
            'whatsapp' => '+62 812-1315-0137',
            'linkedin' => 'https://linkedin.com/in/yourprofile',
            'github' => 'https://github.com/yourusername',
            'skills' => [],
        ]);
    }
}
