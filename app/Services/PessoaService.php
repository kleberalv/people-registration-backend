<?php

namespace App\Services;

use App\Repositories\PessoaRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PessoaService
{
    protected $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;
    }

    public function getAll()
    {
        return $this->pessoaRepository->all();
    }

    public function getById($id)
    {
        return $this->pessoaRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->pessoaRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->pessoaRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->pessoaRepository->delete($id);
    }

    public function validatePessoaInput($data, $isUpdate = false)
    {
        $rules = [
            'nome' => 'required|string|max:50',
            'cpf' => 'required|string|size:11|unique:pessoas,cpf' . ($isUpdate ? ',' . $data['id'] : ''),
            'email' => 'nullable|email|max:50',
            'telefone' => 'nullable|string|max:50',
            'nome_social' => 'nullable|string|max:50',
            'nome_pai' => 'nullable|string|max:50',
            'nome_mae' => 'nullable|string|max:50'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return [
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ];
        }

        return null;
    }
}
