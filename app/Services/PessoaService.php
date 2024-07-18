<?php

namespace App\Services;

use App\Repositories\PessoaRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Exception;

class PessoaService
{
    protected $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;
    }

    public function getAllPessoas()
    {
        try {
            return $this->pessoaRepository->getAllPessoas();
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar pessoas: ' . $e->getMessage());
        }
    }

    public function getById($id)
    {
        try {
            return $this->pessoaRepository->getById($id);
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar pessoa: ' . $e->getMessage());
        }
    }

    public function validatePessoaInput($data, $isUpdate = false)
    {
        $rules = [
            'nome' => 'required|string|max:50',
            'nome_social' => 'nullable|string|max:50',
            'cpf' => [
                'required',
                'string',
                'max:11',
                function ($attribute, $value, $fail) use ($data, $isUpdate) {
                    $existingPerson = $this->pessoaRepository->getByCpf($value);
                    if ($existingPerson && (!$isUpdate || $existingPerson->id != $data['id'])) {
                        $fail('O CPF informado já está em uso.');
                    }
                },
            ],
            'nome_pai' => 'nullable|string|max:50',
            'nome_mae' => 'nullable|string|max:50',
            'telefone' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:50',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return [
                'message' => 'Erro de validação',
                'errors' => $validator->errors(),
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ];
        }

        return null;
    }

    public function create($data)
    {
        try {
            return $this->pessoaRepository->create($data);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar pessoa: ' . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try {
            return $this->pessoaRepository->update($id, $data);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar pessoa: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->pessoaRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception('Erro ao excluir pessoa: ' . $e->getMessage());
        }
    }
}
