<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'price_per_month',
        'status',
        'cover_image_path',
        'detail_image_paths',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'detail_image_paths' => 'array',
        ];
    }

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
