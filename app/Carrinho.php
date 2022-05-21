<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{

    protected $table = 'carrinho';
    protected $fillable = [
        'cliente_id',
        'produtos_id',
        'data_inicio_periodo',
        'data_final_previsto_periodo',
        'data_final_realizado_periodo',
        'valor_diaria',
        'km_inicial',
        'km_final'
    ];

    public function rules() {
        return [];
    }
}
