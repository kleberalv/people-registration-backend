<?php

namespace App\Services;

use App\Repositories\EnderecoRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Exception;

class EnderecoService
{
    protected $enderecoRepository;

    public function __construct(EnderecoRepository $enderecoRepository)
    {
        $this->enderecoRepository = $enderecoRepository;
    }

    public function validateEnderecoInput($data)
    {
        $rules = [
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:8',
            'pessoa_id' => 'required|exists:pessoas,id',
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
            return $this->enderecoRepository->create($data);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar endereço: ' . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try {
            return $this->enderecoRepository->update($id, $data);
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar endereço: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            return $this->enderecoRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception('Erro ao excluir endereço: ' . $e->getMessage());
        }
    }
}
