<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome', 'nome_social', 'cpf', 'nome_pai', 'nome_mae', 'telefone', 'email'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    protected static function booted()
    {
        static::deleting(function ($pessoa) {
            $pessoa->enderecos()->delete();
        });
    }
}
