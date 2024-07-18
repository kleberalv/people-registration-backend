<?php

namespace App\Repositories;

use App\Models\Endereco;
use Exception;

class EnderecoRepository
{
    public function create($data)
    {
        try {
            return Endereco::create($data);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar endereço: ' . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try {
            $endereco = Endereco::findOrFail($id);
            $endereco->update($data);
            return $endereco;
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar endereço: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $endereco = Endereco::findOrFail($id);
            $endereco->delete();
            return $endereco;
        } catch (Exception $e) {
            throw new Exception('Erro ao excluir endereço: ' . $e->getMessage());
        }
    }
}
