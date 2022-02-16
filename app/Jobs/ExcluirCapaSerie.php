<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaSerie implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $capaSerie;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $capaSerie)
    {
        $this->capaSerie = $capaSerie;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $capaSerie = $this->capaSerie;

        if($capaSerie) {
            Storage::delete($capaSerie);
        }
    }
}
