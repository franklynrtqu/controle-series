<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogNovaSerieCadastrada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nome = $event->nome;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;

        \Log::info('Série nova cadastrada '. $nome);
    }
}
