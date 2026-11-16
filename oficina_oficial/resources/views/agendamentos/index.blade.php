@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Agendamentos (Ordenados por Data)</h3>
    <a href="{{ route('agendamentos.create') }}" class="btn btn-success">+ Novo Agendamento</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>Dia / Horário</th>
                <th>Serviço</th>
                <th>Status</th>
                <th>Dados Completos do Cliente</th>
                <th>Dados Completos do Veículo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendamentos as $ag)
            <tr>
                <td class="fw-bold text-primary">{{ $ag->data_agendamento->format('d/m/Y H:i') }}</td>
                <td>{{ $ag->descricao_servico }}</td>
                <td><span class="badge bg-info text-dark">{{ $ag->status }}</span></td>
                <td>
                    <strong>{{ $ag->cliente->nome }}</strong><br>
                    <small class="text-muted">CPF: {{ $ag->cliente->cpf }} | Tel: {{ $ag->cliente->telefone }} | E-mail: {{ $ag->cliente->email ?? '-' }}</small>
                </td>
                <td>
                    <strong>{{ $ag->veiculo->marca }} {{ $ag->veiculo->modelo }}</strong><br>
                    <small class="text-muted">Placa: {{ $ag->veiculo->placa }} | Ano: {{ $ag->veiculo->ano }}</small>
                </td>
                <td>
                    <a href="{{ route('agendamentos.edit', $ag) }}" class="btn btn-sm btn-warning">Atualizar Data</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">Nenhum agendamento registrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
