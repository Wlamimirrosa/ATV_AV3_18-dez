<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos, 200);
    }

    // Obter detalhes de um produto específico
    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return response()->json($produto, 200);
    }

    // Criar um novo produto
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            // Adicione outras regras de validação conforme necessário
        ]);

        $produto = Produto::create([
            'nome' => $request->input('nome'),
            'preco' => $request->input('preco'),
            'categoria_id' => $request->input('categoria_id'),
            // Adicione outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Produto criado com sucesso', 'produto' => $produto], 201);
    }

    // Atualizar os detalhes de um produto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'string|max:255',
            'preco' => 'numeric|min:0',
            'categoria_id' => 'exists:categorias,id',
            // Adicione outras regras de validação conforme necessário
        ]);

        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome' => $request->input('nome', $produto->nome),
            'preco' => $request->input('preco', $produto->preco),
            'categoria_id' => $request->input('categoria_id', $produto->categoria_id),
            // Atualize outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Produto atualizado com sucesso', 'produto' => $produto], 200);
    }

    // Excluir um produto
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso'], 200);
    }
}
