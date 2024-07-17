<?php

namespace App\Http\Controllers;

use App\Services\EnderecoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnderecoController extends Controller
{
    protected $enderecoService;

    public function __construct(EnderecoService $enderecoService)
    {
        $this->enderecoService = $enderecoService;
    }

    public function store(Request $request, $pessoaId)
    {
        $data = $request->all();
        $data['pessoa_id'] = $pessoaId;
        $this->enderecoService->create($data);
        return response()->json(['message' => 'Endereço criado com sucesso!'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $this->enderecoService->update($id, $request->all());
        return response()->json(['message' => 'Endereço atualizado com sucesso!'], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $this->enderecoService->delete($id);
        return response()->json(['message' => 'Endereço excluído com sucesso!'], Response::HTTP_OK);
    }
}
