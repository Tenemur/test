<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{

    // у каждой заявки может быть один отзыв
    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    // каждая заявка принадлежит одному пользователю
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // поля, которые можно заполнять, отправив реквест
    protected $fillable = [
        'room',
        'starts_at',
        'status',
        'payment',
        'user_id'
    ];
}
