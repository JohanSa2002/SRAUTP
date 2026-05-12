<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'start_date',
        'end_date',
        'categories',
        'is_active',
    ];

    protected $casts = [
        'categories' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
