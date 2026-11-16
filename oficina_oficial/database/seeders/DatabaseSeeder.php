<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Agendamento;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Mínimo 3 registros em users
        User::create(['name' => 'Administrador Oficina', 'email' => 'admin@oficina.com', 'password' => Hash::make('123456')]);
        User::create(['name' => 'Carlos Mecânico', 'email' => 'carlos@oficina.com', 'password' => Hash::make('123456')]);
        User::create(['name' => 'Ana Recepção', 'email' => 'ana@oficina.com', 'password' => Hash::make('123456')]);

        // Mínimo 3 registros em clientes (CPF criptografado automaticamente pelo cast 'encrypted')
        $c1 = Cliente::create(['nome' => 'João da Silva', 'cpf' => '111.222.333-44', 'telefone' => '(11) 98888-1111', 'email' => 'joao@email.com']);
        $c2 = Cliente::create(['nome' => 'Maria Oliveira', 'cpf' => '222.333.444-55', 'telefone' => '(11) 97777-2222', 'email' => 'maria@email.com']);
        $c3 = Cliente::create(['nome' => 'Pedro Santos', 'cpf' => '333.444.555-66', 'telefone' => '(11) 96666-3333', 'email' => 'pedro@email.com']);

        // Mínimo 3 registros em veiculos
        $v1 = Veiculo::create(['cliente_id' => $c1->id, 'placa' => 'ABC1D23', 'marca' => 'Volkswagen', 'modelo' => 'Gol 1.6', 'ano' => 2020]);
        $v2 = Veiculo::create(['cliente_id' => $c2->id, 'placa' => 'XYZ9K88', 'marca' => 'Fiat', 'modelo' => 'Argo Drive', 'ano' => 2022]);
        $v3 = Veiculo::create(['cliente_id' => $c3->id, 'placa' => 'JKL4M56', 'marca' => 'Chevrolet', 'modelo' => 'Onix LT', 'ano' => 2021]);

        // Mínimo 3 registros em agendamentos
        Agendamento::create(['cliente_id' => $c1->id, 'veiculo_id' => $v1->id, 'data_agendamento' => '2026-11-18 09:00:00', 'descricao_servico' => 'Troca de óleo e filtros', 'status' => 'Pendente']);
        Agendamento::create(['cliente_id' => $c2->id, 'veiculo_id' => $v2->id, 'data_agendamento' => '2026-11-17 14:30:00', 'descricao_servico' => 'Alinhamento e balanceamento', 'status' => 'Pendente']);
        Agendamento::create(['cliente_id' => $c3->id, 'veiculo_id' => $v3->id, 'data_agendamento' => '2026-11-19 10:00:00', 'descricao_servico' => 'Revisão sistema de freios', 'status' => 'Em Andamento']);
    }
}
