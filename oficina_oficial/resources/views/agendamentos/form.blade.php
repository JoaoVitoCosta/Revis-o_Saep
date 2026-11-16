@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Novo Agendamento</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('agendamentos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Cliente *</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">Selecione o cliente...</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Veículo *</label>
                <select name="veiculo_id" class="form-select" required>
                    <option value="">Selecione o veículo...</option>
                    @foreach($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}">{{ $veiculo->placa }} - {{ $veiculo->marca }} {{ $veiculo->modelo }} (Proprietário: {{ $veiculo->cliente->nome }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Data e Hora do Agendamento *</label>
                <input type="datetime-local" name="data_agendamento" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descrição do Serviço *</label>
                <input type="text" name="descricao_servico" class="form-control" placeholder="Ex: Troca de óleo e filtros" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status *</label>
                <select name="status" class="form-select">
                    <option value="Pendente">Pendente</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Concluido">Concluido</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Confirmar Agendamento</button>
            </div>
        </form>
    </div>
</div>
@endsection
