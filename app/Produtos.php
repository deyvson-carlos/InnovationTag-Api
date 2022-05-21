<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $fillable = ['vendedor_id', 'placa', 'disponivel', 'km'];
    protected $table = 'produtos'; //chama a tabela do banco

    public function rules(){
        return [
            'vendedor_id' => 'exists:vendedor,id',
            'placa' => 'required',
            'disponivel' => 'required',
            'km' => 'required'
          ];
    }

    public function vendedor(){
        return $this->belongsTo('App\Vendedor');
    }
}
