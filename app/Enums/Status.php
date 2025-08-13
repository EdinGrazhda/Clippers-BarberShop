<?php

namespace App\Enums;

enum Status: string
{
    // Common statuses
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    
    // Appointment specific statuses
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case NO_SHOW = 'no_show';
    
    // Barber specific statuses
    case AVAILABLE = 'available';
    case BUSY = 'busy';
    case ON_BREAK = 'on_break';
    case OFF_DUTY = 'off_duty';

    /**
     * Get all appointment statuses
     */
    public static function appointmentStatuses(): array
    {
        return [
            self::PENDING,
            self::CONFIRMED,
            self::COMPLETED,
            self::CANCELLED,
            self::NO_SHOW,
        ];
    }

    /**
     * Get all barber statuses
     */
    public static function barberStatuses(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::AVAILABLE,
            self::BUSY,
            self::ON_BREAK,
            self::OFF_DUTY,
        ];
    }

    /**
     * Get status label for display
     */
    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::PENDING => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            self::NO_SHOW => 'No Show',
            self::AVAILABLE => 'Available',
            self::BUSY => 'Busy',
            self::ON_BREAK => 'On Break',
            self::OFF_DUTY => 'Off Duty',
        };
    }

    /**
     * Get status color class for UI
     */
    public function colorClass(): string
    {
        return match($this) {
            self::ACTIVE, self::CONFIRMED, self::COMPLETED, self::AVAILABLE => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            self::PENDING => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            self::CANCELLED, self::NO_SHOW, self::INACTIVE, self::OFF_DUTY => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
            self::BUSY, self::ON_BREAK => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300',
        };
    }

    /**
     * Get all status values as array
     */
    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    /**
     * Get all status labels as array
     */
    public static function labels(): array
    {
        return array_map(fn($case) => $case->label(), self::cases());
    }

    /**
     * Check if status is for appointments
     */
    public function isAppointmentStatus(): bool
    {
        return in_array($this, self::appointmentStatuses());
    }

    /**
     * Check if status is for barbers
     */
    public function isBarberStatus(): bool
    {
        return in_array($this, self::barberStatuses());
    }
}
