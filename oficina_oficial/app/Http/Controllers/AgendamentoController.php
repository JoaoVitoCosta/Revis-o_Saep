<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Veiculo;

class AgendamentoController extends Controller
{
    public function index()
    {
        // Listagem ordenada por dia de agendamento trazendo todos os dados do cliente e veículo
        $agendamentos = Agendamento::with(['cliente', 'veiculo'])
            ->orderBy('data_agendamento', 'asc')
            ->get();

        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $veiculos = Veiculo::with('cliente')->get();
        return view('agendamentos.form', compact('clientes', 'veiculos'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'data_agendamento' => 'required|date',
            'descricao_servico' => 'required|string|max:255',
            'status' => 'required|in:Pendente,Em Andamento,Concluido,Cancelado',
        ]);

        Agendamento::create($dados);

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento cadastrado com sucesso!');
    }

    public function edit(Agendamento $agendamento)
    {
        $agendamento->load(['cliente', 'veiculo']);
        return view('agendamentos.editar', compact('agendamento'));
    }

    public function updateData(Request $request, Agendamento $agendamento)
    {
        $dados = $request->validate([
            'data_agendamento' => 'required|date',
        ]);

        $agendamento->update([
            'data_agendamento' => $dados['data_agendamento'],
        ]);

        return redirect()->route('agendamentos.index')->with('success', 'Data do agendamento atualizada com sucesso!');
    }
}
