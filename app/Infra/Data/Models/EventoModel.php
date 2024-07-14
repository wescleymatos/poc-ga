<?php

namespace App\Infra\Data\Models;

use Illuminate\Database\Eloquent\Model;

class EventoModel extends Model
{
    protected $table = 'eventos';
    protected $fillable = ['nome', 'descricao', 'identificador', 'data_evento'];
}
