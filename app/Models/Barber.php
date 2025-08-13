<?php

namespace App\Models;

use App\Enums\Status;
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
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'specialties' => 'array',
        'status' => Status::class,
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
