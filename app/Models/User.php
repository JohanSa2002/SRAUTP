<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'cedula',
        'name',
        'email',
        'institutional_email',
        'description',
        'profile_photo_path',
        'is_advisor',
        'is_admin',
        'is_advisor_assistant',
        'parent_advisor_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_advisor' => 'boolean',
            'is_advisor_assistant' => 'boolean',
        ];
    }

    /**
     * True for both full advisors and advisor assistants.
     * Use this for article access/evaluation permissions.
     * For registering assistants, check is_advisor directly.
     */
    public function isAdvisorRole(): bool
    {
        return $this->is_advisor || $this->is_advisor_assistant;
    }

    public function parentAdvisor()
    {
        return $this->belongsTo(User::class, 'parent_advisor_id');
    }

    public function advisorAssistants()
    {
        return $this->hasMany(User::class, 'parent_advisor_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
