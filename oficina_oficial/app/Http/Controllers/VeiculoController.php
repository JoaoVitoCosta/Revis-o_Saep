<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Cliente;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::with('cliente')->orderBy('id', 'desc')->get();
        return view('veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('veiculos.form', compact('clientes'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'placa' => 'required|string|max:10|unique:veiculos,placa',
            'marca' => 'required|string|max:80',
            'modelo' => 'required|string|max:80',
            'ano' => 'required|integer|min:1900|max:2030',
        ], [
            'cliente_id.required' => 'Você deve associar o veículo a um cliente.',
            'placa.unique' => 'Esta placa já está cadastrada no sistema.',
        ]);

        $dados['placa'] = strtoupper($dados['placa']);
        Veiculo::create($dados);

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado e vinculado ao cliente com sucesso!');
    }
}
