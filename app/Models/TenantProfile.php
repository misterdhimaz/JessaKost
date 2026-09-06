<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenantProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nim',
        'campus',
        'origin_address',
        'parent_name',
        'parent_phone',
        'profile_photo_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
