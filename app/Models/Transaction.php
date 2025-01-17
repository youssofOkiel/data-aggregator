<?php

namespace App\Models;

use App\Enums\DataProviderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'identification',
        'status',
        'currency',
        'amount',
        'date',
        'user_email',
        'provider',
    ];

    protected $casts = [
        'date' => 'date',
        'provider' => DataProviderType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }
}
