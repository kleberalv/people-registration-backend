<?php

namespace App\Services;

use App\Repositories\EnderecoRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EnderecoService
{
    protected $enderecoRepository;

    public function __construct(EnderecoRepository $enderecoRepository)
    {
        $this->enderecoRepository = $enderecoRepository;
    }

    public function create($data)
    {
        $validation = $this->validateEnderecoInput($data);
        if ($validation) {
            return [
                'message' => $validation['message'],
                'errors' => $validation['errors'],
                'status' => $validation['status'],
            ];
        }

        return $this->enderecoRepository->create($data);
    }

    public function update($id, $data)
    {
        $validation = $this->validateEnderecoInput($data);
        if ($validation) {
            return [
                'message' => $validation['message'],
                'errors' => $validation['errors'],
                'status' => $validation['status'],
            ];
        }

        return $this->enderecoRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->enderecoRepository->delete($id);
    }

    public function validateEnderecoInput($data)
    {
        $rules = [
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:10',
            'pessoa_id' => 'required|exists:pessoas,id',
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
