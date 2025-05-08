<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $gurded = [
        'id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
