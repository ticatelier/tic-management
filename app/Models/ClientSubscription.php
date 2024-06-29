<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_option_id',
        'status',
        'duration',
        'autorenewal',
        'posnumber',
        'startdate',
        'duedate',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(ServiceOption::class, 'service_option_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
