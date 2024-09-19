<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Seller;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'seller_id',
        'sold_at',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'status' => status::class
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
