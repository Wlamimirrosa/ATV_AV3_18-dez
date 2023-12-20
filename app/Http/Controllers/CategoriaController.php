<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    // Listar todas as categorias
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias, 200);
    }

    // Obter detalhes de uma categoria específica
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria, 200);
    }

    // Criar uma nova categoria
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            // Adicione outras regras de validação conforme necessário
        ]);

        $categoria = Categoria::create([
            'nome' => $request->input('nome'),
            // Adicione outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Categoria criada com sucesso', 'categoria' => $categoria], 201);
    }

    // Atualizar os detalhes de uma categoria
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'string|max:255',
            // Adicione outras regras de validação conforme necessário
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->update([
            'nome' => $request->input('nome', $categoria->nome),
            // Atualize outros campos conforme necessário
        ]);

        return response()->json(['message' => 'Categoria atualizada com sucesso', 'categoria' => $categoria], 200);
    }

    // Excluir uma categoria
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(['message' => 'Categoria excluída com sucesso'], 200);
    }
}
