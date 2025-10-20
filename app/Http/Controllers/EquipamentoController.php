<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar os dados que vêm do front-end
        $dadosValidados = $request->validate([
            'descricao' => 'required|string|max:255',
            'tipo_id' => 'required|integer',
            'unidade_empresa_id' => 'required|integer', // O front-end DEVE enviar a qual unidade o equipamento pertence
            'local_id' => 'required|integer',
            'situacao_id' => 'required|integer',
        ]);

        // 2. PEGAR O ID DA UNIDADE QUE O USUÁRIO QUER AFETAR
        $unidadeId = $dadosValidados['unidade_empresa_id'];
        

        // 3. USAR O GATE PARA AUTORIZAR A AÇÃO
        // "Verifique se o usuário logado 'pode-operar-na-unidade' $unidadeId"
        if (Gate::denies('pode-operar-na-unidade', $unidadeId)) {
            // Se o Gate disser "não" (denies), retorne um erro 403 (Proibido)
            return response()->json(['message' => 'Você não tem permissão para criar equipamentos nesta unidade.'], 403);
        }

        // 4. Se o Gate disser "sim", continue e crie o equipamento
        $equipamento = Equipamento::create($dadosValidados);

        return response()->json($equipamento, 201); // 201 = Criado com Sucesso
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
