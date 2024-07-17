<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pessoa;
use App\Models\Endereco;

class PessoasSeeder extends Seeder
{
    public function run()
    {
        Pessoa::factory()->count(5)->create()->each(function ($pessoa) {
            Endereco::factory()->count(2)->create(['pessoa_id' => $pessoa->id]);
        });
    }
}
