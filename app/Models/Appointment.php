<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointment';
    
    protected $fillable = [
        'barber_id',
        'appointment_time',
        'customer_name',
        'customer_phone',
        'notes',
        'status',
    ];

    protected $casts = [
        'appointment_time' => 'datetime',
        'status' => Status::class,
    ];

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
