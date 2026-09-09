<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricityReading extends Model
{
    /** @use HasFactory<\Database\Factories\ElectricityReadingFactory> */
    use HasFactory;

    protected $fillable = [
        'room_id',
        'reading_month',
        'kwh_used',
        'image_proof'
    ];
}
