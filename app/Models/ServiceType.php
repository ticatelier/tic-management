<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description'
    ];

    public function options(): HasMany
    {
        return $this->hasMany(ServiceOption::class, 'service_type_id');
    }
}
