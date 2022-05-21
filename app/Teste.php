<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teste extends Model
{
    protected $fillable = ['nome', 'imagem'];
    protected $table = 'teste'; //chama a tabela do banco

    public function rules(){
        return  [
            'nome' => 'required|unique:teste,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,pdf,docx,xlsx,ppt,mp3'
          ];
    }

    public function feedback (){
     return   [
            'required' => 'O campo :attribute é obrigatório',
            'imagem.mimes' => 'O arquivo deve ser uma imagem do tipo solicitado',
            'nome.unique' => 'O nome do teste já existe',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres'
          ];

    }

    public function vendedor() {
        //um teste possui vários vendedores
        return $this->hasMany('App\Teste');
    }

}
