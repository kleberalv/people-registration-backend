<?php

namespace App\Http\Controllers;

use App\Services\PessoaService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PessoaController extends Controller
{
    protected $pessoaService;

    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    public function index()
    {
        $pessoas = $this->pessoaService->getAll();
        return response()->json($pessoas, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validation = $this->pessoaService->validatePessoaInput($request->all());
        if ($validation) {
            return response()->json([
                'message' => $validation['message'],
                'errors' => $validation['errors']
            ], $validation['status']);
        }

        $this->pessoaService->create($request->all());
        return response()->json(['message' => 'Pessoa criada com sucesso!'], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $pessoa = $this->pessoaService->getById($id);
        return response()->json($pessoa, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $validation = $this->pessoaService->validatePessoaInput($request->all(), true);
        if ($validation) {
            return response()->json([
                'message' => $validation['message'],
                'errors' => $validation['errors']
            ], $validation['status']);
        }

        $this->pessoaService->update($id, $request->all());
        return response()->json(['message' => 'Pessoa atualizada com sucesso!'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->pessoaService->delete($id);
        return response()->json(['message' => 'Pessoa excluída com sucesso!'], Response::HTTP_OK);
    }
}
