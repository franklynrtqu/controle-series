<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    //protected $table = 'series';

    public $timestamps = false;
    // Define atributos que podem ser mandados direto para o método "created"
    protected $fillable = ['nome', 'capa'];

    // Aqui é usado um Acessor, para pega lá na view o retorno dele, como "capa_url".
    public function getCapaUrlAttribute()
    {
        if ($this->capa) {
            return Storage::url($this->capa);
        }
        return Storage::url('serie/sem-imagem.jpg');
    }


    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
