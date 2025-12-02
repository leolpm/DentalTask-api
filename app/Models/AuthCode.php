<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthCode extends Model
{
    // Nome da tabela: o padrão já seria auth_codes,
    // então essa linha é opcional se o nome estiver certinho.
    protected $table = 'auth_codes';

    protected $fillable = [
        'code',
        'expires_at',
        // coloque aqui campos extras da sua migration se tiver:
        'channel',
        'sent_to',
        'user_id',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // Se sua tabela tiver user_id, você pode ter:
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
