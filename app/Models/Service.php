<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @OA\Schema(
 *     schema="Service",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="uuid", type="string"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="category", type="string"),
 *     @OA\Property(property="price", type="number", format="float"),
 *     @OA\Property(property="description", type="string"),
 * )
 */
class Service extends Model
{
    use HasFactory, UuidTrait;

    protected $guarded = ['id'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
