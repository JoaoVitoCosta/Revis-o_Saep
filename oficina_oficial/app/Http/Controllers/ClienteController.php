<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $termo = trim($request->input('busca', ''));
        $clientes = Cliente::orderBy('nome')->get();

        // Busca filtrando após descriptografia em memória para permitir localizar também por CPF
        if ($termo !== '') {
            $clientes = $clientes->filter(function ($cliente) use ($termo) {
                return stripos($cliente->nome, $termo) !== false
                    || stripos($cliente->cpf, $termo) !== false
                    || stripos($cliente->telefone, $termo) !== false
                    || stripos((string) $cliente->email, $termo) !== false;
            });
        }

        return view('clientes.index', compact('clientes', 'termo'));
    }

    public function create()
    {
        return view('clientes.form');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'cpf' => 'required|string|max:14',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:150',
        ], [
            'nome.required' => 'O nome do cliente é obrigatório.',
            'cpf.required' => 'O CPF do cliente é obrigatório.',
            'telefone.required' => 'O telefone é obrigatório.',
        ]);

        Cliente::create($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso! CPF armazenado criptografado.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.form', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'cpf' => 'required|string|max:14',
            'telefone' => 'required|string|max:20',
            'email' => 'nullable|email|max:150',
        ]);

        $cliente->update($dados);

        return redirect()->route('clientes.index')->with('success', 'Dados do cliente atualizados com sucesso!');
    }
}
