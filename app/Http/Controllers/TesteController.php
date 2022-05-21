<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Teste;
use Illuminate\Http\Request;
use App\Repositories\TesteRepository;

class TesteController extends Controller
{

    public function __construct(Teste $teste) {
        $this->teste = $teste;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $testeRepository = new TesteRepository($this->teste);

        if($request->has('atributos_vendedor')){
            $atributos_vendedor = 'vendedor:id,'.$request->atributos_vendedor;
            $testeRepository->selectAtributosRegistrosRelacionados($atributos_vendedor);
        }

        else{
            $testeRepository->selectAtributosRegistrosRelacionados('vendedor');
        }

        if($request->has('filtro')){
            $testeRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $testeRepository->selectAtributos($request->atributos);
        }

        return response()->json($testeRepository->getResultado(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate($this->teste->rules(), $this->teste->feedback());

       $imagem = $request->file('imagem');
      $imagem_urn = $imagem->store('imagens_Tag', 'public');

       $teste = $this->teste->create([
           'nome' => $request->nome,
           'imagem' => $imagem_urn
       ]);

        return response()->json($teste, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teste = $this->teste->with('vendedor')->find($id);
        if($teste === null){
            return response()->json(['erro' => 'Recurso pesquisado não exite'], 404);
        }
        return response()->json($teste, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $teste = $this->teste->find($id);

      if($teste === null){
        return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
      }

      if($request->method() === 'PATCH') {

          return ['Verbo PATCH'];

          $regrasDinamicas = array();

          foreach($teste->rules() as $input => $regra) {

            if(array_key_exists($input, $request->all())) {
                $regrasDinamicas[$input] = $regra;
            }
          }
          //dd($regrasDinamicas);

          $request->validate($regrasDinamicas, $teste->feedback());
      }

      else{
        $request->validate($teste->rules(), $teste->feedback());
      }

      //remove o arquivo antigo caso um novo tenha sido enviado
      if($request->file('imagem')) {
        Storage::disk('public')->delete($teste->imagem);
      }

      $imagem = $request->file('imagem');
      $imagem_urn = $imagem->store('imagens_Tag', 'public');

      $teste->fill($request->all());
      $teste->imagem = $imagem_urn;
      $teste->save();

    //   $teste->update([
    //     'nome' => $request->nome,
    //     'imagem' => $imagem_urn
    // ]);

      return response()->json($teste, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $teste = $this->teste->find($id);

      if($teste === null){
        return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
      }

       //remove o arquivo antigo caso um novo tenha sido enviado
       Storage::disk('public')->delete($teste->imagem);

      $teste->delete();
      return response()->json(['msg' => 'O teste foi removido com sucesso!'], 200);
    }
}
