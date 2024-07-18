<?php

namespace App\Http\Controllers;

use App\Services\EnderecoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class EnderecoController extends Controller
{
    protected $enderecoService;

    public function __construct(EnderecoService $enderecoService)
    {
        $this->enderecoService = $enderecoService;
    }

    public function store(Request $request, $pessoaId)
    {
        try {
            $data = $request->all();
            $data['pessoa_id'] = $pessoaId;
            $validation = $this->enderecoService->validateEnderecoInput($data);
            if ($validation) {
                return response()->json(['message' => $validation['message'], 'errors' => $validation['errors']], $validation['status']);
            }
            $this->enderecoService->create($data);
            return response()->json(['message' => 'Endereço criado com sucesso!'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao criar endereço: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validation = $this->enderecoService->validateEnderecoInput($request->all());
            if ($validation) {
                return response()->json(['message' => $validation['message'], 'errors' => $validation['errors']], $validation['status']);
            }
            $this->enderecoService->update($id, $request->all());
            return response()->json(['message' => 'Endereço atualizado com sucesso!'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar endereço: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->enderecoService->delete($id);
            return response()->json(['message' => 'Endereço excluído com sucesso!'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao excluir endereço: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
