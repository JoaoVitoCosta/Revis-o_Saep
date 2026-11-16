<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
    ];

    // Criptografia AES-256 nativa do Laravel para proteção do CPF (LGPD)
    protected $casts = [
        'cpf' => 'encrypted',
    ];

    public function veiculos(): HasMany
    {
        return $this->hasMany(Veiculo::class);
    }

    public function agendamentos(): HasMany
    {
        return $this->hasMany(Agendamento::class);
    }
}
