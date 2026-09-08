<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'lease_id',
        'type',
        'amount',
        'due_date',
        'status',
        'payment_url',
        'token_code',
        'token_proof_path',
        'paid_at',
        'billing_period'
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    /** @return BelongsTo<\App\Models\Lease, $this> */
    public function lease(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }

    /**
     * Get human-readable type label.
     */
    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'rent' => 'Sewa Kamar',
            'electricity' => 'Listrik',
            'internet' => 'WiFi / Internet',
            'other' => 'Lainnya',
            default => $this->type,
        };
    }

    /**
     * Get icon for bill type.
     */
    public function getTypeIconAttribute(): string
    {
        return match ($this->type) {
            'rent' => 'fa-home',
            'electricity' => 'fa-bolt',
            'internet' => 'fa-wifi',
            'other' => 'fa-file-alt',
            default => 'fa-file-invoice',
        };
    }

    /**
     * Get color for bill type.
     */
    public function getTypeColorAttribute(): string
    {
        return match ($this->type) {
            'rent' => 'jessa-maroon',
            'electricity' => 'yellow-500',
            'internet' => 'purple-500',
            'other' => 'gray-500',
            default => 'gray-500',
        };
    }
}
