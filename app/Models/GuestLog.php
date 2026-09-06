<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_name',
        'visit_date',
        'purpose',
        'related_tenant_id',
        'id_card_photo_path',
        'is_overnight',
    ];
}
