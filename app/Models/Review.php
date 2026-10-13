<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    // каждый отзыв принадлежит одной заявке
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    // каждый отзыв принадлежит одному пользователю
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // поля, которые можно заполнять, отправив реквест
    protected $fillable = [
        'content',
        'user_id',
        'application_id'
    ];
}
