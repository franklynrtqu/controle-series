<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request)
    {
        return view('episodios.index', [
            'episodios' => $temporada->episodios,
            'temporadaId' => $temporada->id,
            'mensagem' => $request->session()->get('mensagem')
        ]);
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
        });
        // Depois de ter sido setado como true ou false cada uma dos episódios,
        // por chamar o método "push()" ele efetiva cada uma das alterações da temporada, bem como
        // dos registros de episodio relacioandaos a ele.
        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios marcados como assistidos.');

        return redirect()->back();
    }
}
