<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Mail\NovaSerie as MailNovaSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
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

        // ---- E-MAIL ----
        $users = User::all();

        foreach ($users as $index => $user) {
            $email = new MailNovaSerie(
                $nome,
                $qtdTemporadas,
                $qtdEpisodios,
            );

            $email->subject = 'Nova Série Adicionada';

            $when = now()->addSeconds($index * 5);
            Mail::to($user)
                ->later($when, $email);
        }
        // -----
    }
}
