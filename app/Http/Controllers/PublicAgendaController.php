<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Carbon\Carbon;

class PublicAgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('start_at')->orWhere('start_at', '>=', Carbon::now()->subDay());
            })
            ->orderBy('start_at')
            ->paginate(10);

        return view('public.agenda', compact('agendas'));
    }
}
