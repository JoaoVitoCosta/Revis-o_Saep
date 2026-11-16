<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->text('cpf'); // TEXT para comportar string criptografada (LGPD)
            $table->string('telefone', 20);
            $table->string('email', 150)->nullable();
            $table->timestamps();
        });

        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('placa', 10)->unique();
            $table->string('marca', 80);
            $table->string('modelo', 80);
            $table->integer('ano');
            $table->timestamps();
        });

        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('veiculo_id')->constrained('veiculos')->onDelete('cascade');
            $table->dateTime('data_agendamento');
            $table->string('descricao_servico', 255);
            $table->enum('status', ['Pendente', 'Em Andamento', 'Concluido', 'Cancelado'])->default('Pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
        Schema::dropIfExists('veiculos');
        Schema::dropIfExists('clientes');
    }
};
