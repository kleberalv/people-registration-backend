<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pessoa_id', 'tipo', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'estado', 'cidade'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
