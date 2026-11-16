@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Gerenciamento de Veículos</h3>
    <a href="{{ route('veiculos.create') }}" class="btn btn-success">+ Novo Veículo</a>
</div>

<div class="table-responsive bg-white rounded shadow-sm">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Marca / Modelo</th>
                <th>Ano</th>
                <th>Cliente Proprietário</th>
            </tr>
        </thead>
        <tbody>
            @forelse($veiculos as $veiculo)
            <tr>
                <td>{{ $veiculo->id }}</td>
                <td><span class="badge bg-secondary fs-6">{{ $veiculo->placa }}</span></td>
                <td>{{ $veiculo->marca }} - {{ $veiculo->modelo }}</td>
                <td>{{ $veiculo->ano }}</td>
                <td>{{ $veiculo->cliente->nome }} ({{ $veiculo->cliente->telefone }})</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted">Nenhum veículo cadastrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
