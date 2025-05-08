<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'customer_name', 'phone', 'service_id', 'status', 'schedule_time'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
