<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $fillable = ['teste_id', 'nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs'];
    protected $table = 'vendedor'; //chama a tabela do banco

    public function rules(){
        return [
            'teste_id' => 'exists:teste,id',
            'nome' => 'required|unique:vendedor,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,pdf,docx,xlsx,ppt,mp3',
            'numero_portas' => 'required|integer|digits_between:1,5', //1,2,3,4,5
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean', //true, false, 1,0 "1", "0"
            'abs' => 'required|boolean'
          ];
    }
    public function teste(){
        // um relacionamento um vendedor pertence a um teste
        return $this->belongsTo('App\Teste');
    }

}
