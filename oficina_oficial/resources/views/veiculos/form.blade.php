@extends('layouts.app')

@section('content')
<div class="card shadow-sm col-md-6 mx-auto">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Cadastrar Novo Veículo</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('veiculos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Associar ao Cliente *</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">Selecione o cliente proprietário...</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }} (CPF: {{ $cliente->cpf }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Placa *</label>
                <input type="text" name="placa" value="{{ old('placa') }}" class="form-control" maxlength="10" placeholder="ABC1D23" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Marca *</label>
                <input type="text" name="marca" value="{{ old('marca') }}" class="form-control" placeholder="Ex: Volkswagen" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Modelo *</label>
                <input type="text" name="modelo" value="{{ old('modelo') }}" class="form-control" placeholder="Ex: Gol 1.6" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ano *</label>
                <input type="number" name="ano" value="{{ old('ano') }}" class="form-control" placeholder="Ex: 2022" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar Veículo</button>
            </div>
        </form>
    </div>
</div>
@endsection
