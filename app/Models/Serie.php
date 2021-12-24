<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    //protected $table = 'series';

    public $timestamps = false;
    // Define atributos que podem ser mandados direto para o método "created"
    protected $fillable = ['nome'];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
