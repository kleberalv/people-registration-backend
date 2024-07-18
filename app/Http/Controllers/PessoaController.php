<?php

namespace App\Http\Controllers;

use App\Services\PessoaService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class PessoaController extends Controller
{
    protected $pessoaService;

    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    public function index(Request $request)
    {
        try {
            $pessoas = $this->pessoaService->getAllPessoas();
            return response()->json($pessoas, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao buscar pessoas: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            $validation = $this->pessoaService->validatePessoaInput($request->all());
            if ($validation) {
                return response()->json(['message' => $validation['message'], 'errors' => $validation['errors']], $validation['status']);
            }

            $pessoa = $this->pessoaService->create($request->all());
            return response()->json(['message' => 'Pessoa criada com sucesso!', 'id' => $pessoa->id], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao criar pessoa: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $pessoa = $this->pessoaService->getById($id);
            return response()->json($pessoa, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao buscar pessoa: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validation = $this->pessoaService->validatePessoaInput($request->all(), true);
            if ($validation) {
                return response()->json(['message' => $validation['message'], 'errors' => $validation['errors']], $validation['status']);
            }

            $this->pessoaService->update($id, $request->all());
            return response()->json(['message' => 'Pessoa atualizada com sucesso!'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar pessoa: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $this->pessoaService->delete($id);
            return response()->json(['message' => 'Pessoa excluída com sucesso!'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao excluir pessoa: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
