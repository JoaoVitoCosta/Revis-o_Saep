@extends('layouts.app')

@section('content')
<div class="p-4 bg-white rounded shadow-sm mb-4 border-start border-4 border-primary">
    <h2 class="mb-1">Olá, {{ $usuario->name }}!</h2>
    <p class="text-muted mb-0">Bem-vindo ao painel principal da oficina mecânica. Utilize os atalhos abaixo para navegar.</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Clientes ({{ $totalClientes }})</h5>
                <p class="card-text text-muted">Gerencie o cadastro de clientes com busca rápida e proteção de CPF (LGPD).</p>
                <a href="{{ route('clientes.index') }}" class="btn btn-primary">Acessar Clientes</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Veículos ({{ $totalVeiculos }})</h5>
                <p class="card-text text-muted">Cadastre veículos e associe cada automóvel ao seu respectivo proprietário.</p>
                <a href="{{ route('veiculos.index') }}" class="btn btn-primary">Acessar Veículos</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Agendamentos ({{ $totalAgendamentos }})</h5>
                <p class="card-text text-muted">Consulte horários ordenados por data e reagende serviços facilmente.</p>
                <a href="{{ route('agendamentos.index') }}" class="btn btn-primary">Acessar Agendamentos</a>
            </div>
        </div>
    </div>
</div>
@endsection
