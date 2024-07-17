<?php

namespace Database\Factories;

use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\Factory;

class PessoaFactory extends Factory
{
    protected $model = Pessoa::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'nome_social' => $this->faker->name,
            'cpf' => $this->faker->unique()->numerify('###########'),
            'nome_pai' => $this->faker->name('male'),
            'nome_mae' => $this->faker->name('female'),
            'telefone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
