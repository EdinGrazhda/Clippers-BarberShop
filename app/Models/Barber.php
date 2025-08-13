<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'description',
        'experience_years',
        'specialties',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'specialties' => 'array',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
