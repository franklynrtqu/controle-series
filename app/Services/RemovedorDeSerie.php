<?php

namespace App\Services;

use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        DB::beginTransaction();
        $serie = Serie::find($serieId);
        $nomeSerie = $serie->nome;
        $capaSerie = $serie->capa;
        $this->removerTemporadas($serie);
        $serie->delete();

        //Event
        if(!is_null($capaSerie)) {
            SerieApagada::dispatch($capaSerie);
        }

        //Job
        //ExcluirCapaSerie::dispatch($capaSerie);

        DB::commit();

        return $nomeSerie;
    }

    /**
     * @param $serie
     */
    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
