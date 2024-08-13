<?php

namespace App\Infra\Data\Models;

use Illuminate\Database\Eloquent\Model;

class AuditoriaModel extends Model
{
    const UPDATED_AT = null;

    protected $table = 'auditorias';
    protected $fillable = ['caso_de_uso', 'conteudo', 'identificador', 'identificador_usuario', 'identificador_entidade'];
}
