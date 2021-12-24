<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    public function index(Request $request) {

        $series = Serie::query()
            ->orderBy('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} com suas temporadas e episódios criada com sucesso {$serie->nome}"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        Serie::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie removida com sucesso."
            );
        return redirect()->route('listar_series');
    }

    // Visto que na rota já está esperando um "id", ao definir entre os parâmetros do método
    // um parâmetro "id" com o mesmo nome do parâmetro da rota,
    // o Laravel já atribue a esse parâmetro do método o valor recebido por meio do método "post".
    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
