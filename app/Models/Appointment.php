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
        'customer_email',
        'service',
        'notes',
        'status',
        'reminder_sent',
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
