<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Agendamento;

class DashboardController extends Controller
{
    public function index()
    {
        return view('principal', [
            'usuario' => Auth::user(),
            'totalClientes' => Cliente::count(),
            'totalVeiculos' => Veiculo::count(),
            'totalAgendamentos' => Agendamento::count(),
            'proximosAgendamentos' => Agendamento::with(['cliente', 'veiculo'])
                ->orderBy('data_agendamento', 'asc')
                ->limit(5)
                ->get(),
        ]);
    }
}
