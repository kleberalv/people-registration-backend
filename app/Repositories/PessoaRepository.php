<?php

namespace App\Repositories;

use App\Models\Pessoa;
use Exception;

class PessoaRepository
{
    public function getAllPessoas()
    {
        try {
            return Pessoa::with('enderecos')->whereNull('deleted_at')->get();
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar pessoas: ' . $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            return Pessoa::with('enderecos')->whereNull('deleted_at')->findOrFail($id);
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar pessoa: ' . $e->getMessage());
        }
    }

    public function getByCpf($cpf)
    {
        try {
            return Pessoa::where('cpf', $cpf)->first();
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar pessoa por CPF: ' . $e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            return Pessoa::create($data);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar pessoa: ' . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try {
            $pessoa = $this->getById($id);
            $pessoa->update($data);
            return $pessoa;
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar pessoa: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $pessoa = $this->getById($id);
            $pessoa->delete();
            return $pessoa;
        } catch (Exception $e) {
            throw new Exception('Erro ao excluir pessoa: ' . $e->getMessage());
        }
    }
}
