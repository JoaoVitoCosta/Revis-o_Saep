@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">{{ isset($cliente) ? 'Editar Cliente' : 'Cadastrar Novo Cliente' }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ isset($cliente) ? route('clientes.update', $cliente) : route('clientes.store') }}" method="POST">
            @csrf
            @if(isset($cliente))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Nome Completo *</label>
                <input type="text" name="nome" value="{{ old('nome', $cliente->nome ?? '') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CPF * (Armazenado criptografado no banco)</label>
                <input type="text" name="cpf" value="{{ old('cpf', $cliente->cpf ?? '') }}" class="form-control" placeholder="000.000.000-00" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone *</label>
                <input type="text" name="telefone" value="{{ old('telefone', $cliente->telefone ?? '') }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $cliente->email ?? '') }}" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
@endsection
