@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Gerenciamento de Clientes</h3>
    <a href="{{ route('clientes.create') }}" class="btn btn-success">+ Novo Cliente</a>
</div>

<form action="{{ route('clientes.index') }}" method="GET" class="row g-2 mb-4">
    <div class="col-md-8">
        <input type="text" name="busca" value="{{ $termo }}" class="form-control" placeholder="Digite o termo para buscar (nome, CPF, telefone ou e-mail)...">
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-primary">Confirmar Busca</button>
        @if($termo)
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Limpar</a>
        @endif
    </div>
</form>

<div class="table-responsive bg-white rounded shadow-sm">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF (Protegido LGPD)</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td class="fw-semibold">{{ $cliente->nome }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->email ?? '-' }}</td>
                <td>
                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning">Editar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">Nenhum cliente encontrado para o termo informado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
