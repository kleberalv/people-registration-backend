<?php

namespace App\Repositories;

use App\Models\Pessoa;

class PessoaRepository
{
    protected $pessoa;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    public function all()
    {
        return $this->pessoa->with('enderecos')->get();
    }

    public function find($id)
    {
        return $this->pessoa->with('enderecos')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->pessoa->create($data);
    }

    public function update($id, array $data)
    {
        $pessoa = $this->pessoa->findOrFail($id);
        $pessoa->update($data);
        return $pessoa;
    }

    public function delete($id)
    {
        $pessoa = $this->pessoa->findOrFail($id);
        return $pessoa->delete();
    }
}
