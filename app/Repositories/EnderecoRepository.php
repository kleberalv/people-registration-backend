<?php

namespace App\Repositories;

use App\Models\Endereco;

class EnderecoRepository
{
    public function create($data)
    {
        return Endereco::create($data);
    }

    public function update($id, $data)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->update($data);
        return $endereco;
    }

    public function delete($id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();
        return $endereco;
    }
}
