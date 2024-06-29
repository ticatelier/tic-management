<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'trainer_id',
        'client_subscription_id',
        'day',
        'month',
        'year',
        'timein',
        'timeout',
        'daily_hour',
        'Location',
        'medadmin',
        'medchanges',
        'categories',
        'behaviour',
        'activities'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(ClientSubscription::class, 'client_subscription_id');
    }
}
