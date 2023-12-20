<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Frete;

class PedidoController extends Controller
{
    // Listar todos os pedidos
    public function index()
    {
        $pedidos = Pedido::all();
        return response()->json($pedidos, 200);
    }

    // Obter detalhes de um pedido específico
    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return response()->json($pedido, 200);
    }

    // Criar um novo pedido
    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            // Adicione outras regras de validação conforme necessário
        ]);

        $produto = Produto::findOrFail($request->input('produto_id'));

        // Lógica para calcular o valor total do pedido (pode variar dependendo dos requisitos)
        $valorTotal = $produto->preco * $request->input('quantidade');

        $pedido = Pedido::create([
            'produto_id' => $request->input('produto_id'),
            'quantidade' => $request->input('quantidade'),
            'valor_total' => $valorTotal,
            // Adicione outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Pedido realizado com sucesso', 'pedido' => $pedido], 201);
    }

    // Atualizar os detalhes de um pedido
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantidade' => 'integer|min:1',
            // Adicione outras regras de validação conforme necessário
        ]);

        $pedido = Pedido::findOrFail($id);

        $pedido->update([
            'quantidade' => $request->input('quantidade', $pedido->quantidade),
            // Atualize outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Pedido atualizado com sucesso', 'pedido' => $pedido], 200);
    }

    // Excluir um pedido
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return response()->json(['message' => 'Pedido excluído com sucesso'], 200);
    }

    // Listar todos os fretes
    public function listarFretes()
    {
        $fretes = Frete::all();
        return response()->json($fretes, 200);
    }

    // Obter detalhes de um frete específico
    public function detalhesFrete($id)
    {
        $frete = Frete::findOrFail($id);
        return response()->json($frete, 200);
    }

    // Criar um novo frete
    public function criarFrete(Request $request)
    {
        $request->validate([
            'peso' => 'required|numeric|min:0',
            'valor' => 'required|numeric|min:0',
            // Adicione outras regras de validação conforme necessário
        ]);

        $frete = Frete::create([
            'peso' => $request->input('peso'),
            'valor' => $request->input('valor'),
            // Adicione outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Frete criado com sucesso', 'frete' => $frete], 201);
    }

    // Atualizar os detalhes de um frete
    public function atualizarFrete(Request $request, $id)
    {
        $request->validate([
            'peso' => 'numeric|min:0',
            'valor' => 'numeric|min:0',
            // Adicione outras regras de validação conforme necessário
        ]);

        $frete = Frete::findOrFail($id);

        $frete->update([
            'peso' => $request->input('peso', $frete->peso),
            'valor' => $request->input('valor', $frete->valor),
            // Atualize outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Frete atualizado com sucesso', 'frete' => $frete], 200);
    }

    // Excluir um frete
    public function excluirFrete($id)
    {
        $frete = Frete::findOrFail($id);
        $frete->delete();

        return response()->json(['message' => 'Frete excluído com sucesso'], 200);
    }

    // Calcular frete
    public function calcularFrete(Request $request)
    {
        // Lógica para calcular o frete
        $peso = $request->input('peso', 0); // Peso do produto
        $valorFrete = $peso * 0.5; // cálculo de frete 

        return response()->json(['frete' => $valorFrete], 200);
    }
}
