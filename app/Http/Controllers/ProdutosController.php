<?php

namespace App\Http\Controllers;

use App\Produtos;
use Illuminate\Http\Request;
use App\Repositories\ProdutosRepository;

class ProdutosController extends Controller
{

    public function __construct(Produtos $produtos) {
        $this->produtos = $produtos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtosRepository = new ProdutosRepository($this->produtos);

        if($request->has('atributos_vendedor')){
            $atributos_vendedor = 'vendedor:id,'.$request->atributos_vendedor;
            $produtosRepository->selectAtributosRegistrosRelacionados($atributos_vendedor);
        }

        else{
            $produtosRepository->selectAtributosRegistrosRelacionados('vendedor');
        }

        if($request->has('filtro')){
            $produtosRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $produtosRepository->selectAtributos($request->atributos);
        }

        return response()->json($produtosRepository->getResultado(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->produtos->rules());


       $produtos = $this->produtos->create([
           'vendedor_id' => $request->vendedor_id,
           'placa' => $request->placa,
           'disponivel'  => $request->disponivel,
           'km'  => $request->km
       ]);

        return response()->json($produtos, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produtos = $this->produtos->with('vendedor')->find($id);
        if($produtos === null){
            return response()->json(['erro' => 'Recurso pesquisado não exite'], 404);
        }
        return response()->json($produtos, 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function edit(Produtos $produtos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produtos = $this->produtos->find($id);

        if($produtos === null){
          return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            return ['Verbo PATCH'];

            $regrasDinamicas = array();

            foreach($produtos->rules() as $input => $regra) {

              if(array_key_exists($input, $request->all())) {
                  $regrasDinamicas[$input] = $regra;
              }
            }
            //dd($regrasDinamicas);

            $request->validate($regrasDinamicas);
        }

        else{
          $request->validate($produtos->rules());
        }

        $produtos->fill($request->all());
        $produtos->save();

        return response()->json($produtos, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produtos  $produtos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produtos = $this->produtos->find($id);

      if($produtos === null){
        return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
      }



      $produtos->delete();
      return response()->json(['msg' => 'O produto foi removido com sucesso!'], 200);
    }
}
