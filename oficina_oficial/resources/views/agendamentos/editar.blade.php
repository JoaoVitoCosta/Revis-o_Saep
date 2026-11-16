@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Atualizar Data do Agendamento #{{ $agendamento->id }}</h5>
    </div>
    <div class="card-body">
        <div class="mb-3 p-3 bg-light rounded border">
            <p class="mb-1"><strong>Cliente:</strong> {{ $agendamento->cliente->nome }} ({{ $agendamento->cliente->telefone }})</p>
            <p class="mb-1"><strong>Veículo:</strong> {{ $agendamento->veiculo->marca }} {{ $agendamento->veiculo->modelo }} - Placa {{ $agendamento->veiculo->placa }}</p>
            <p class="mb-0"><strong>Serviço:</strong> {{ $agendamento->descricao_servico }}</p>
        </div>

        <form action="{{ route('agendamentos.updateData', $agendamento) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label">Nova Data e Hora *</label>
                <input type="datetime-local" name="data_agendamento"
                       value="{{ $agendamento->data_agendamento->format('Y-m-d\TH:i') }}"
                       class="form-control" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('agendamentos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar Nova Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
