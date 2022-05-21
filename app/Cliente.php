<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{


    protected $fillable = ['nome'];
    protected $table = 'cliente'; //chama a tabela do banco

    public function rules() {
        return [
            'nome' => 'required'
        ];
    }
}
