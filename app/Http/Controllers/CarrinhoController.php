<?php

namespace App\Http\Controllers;

use App\Carrinho;
use Illuminate\Http\Request;
use App\Repositories\CarrinhoRepository;

class CarrinhoController extends Controller
{
    public function __construct(Carrinho $carrinho) {
        $this->carrinho = $carrinho;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carrinhoRepository = new CarrinhoRepository($this->carrinho);

        if($request->has('filtro')) {
            $carrinhoRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) {
            $carrinhoRepository->selectAtributos($request->atributos);
        }

        return response()->json($carrinhoRepository->getResultado(), 200);
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
        $request->validate($this->carrinho->rules());

        $carrinho = $this->carrinho->create([
            'cliente_id' => $request->cliente_id,
            'produtos_id' => $request->produtos_id,
            'data_inicio_periodo' => $request->data_inicio_periodo,
            'data_final_previsto_periodo' => $request->data_final_previsto_periodo,
            'data_final_realizado_periodo' => $request->data_final_realizado_periodo,
            'valor_diaria' => $request->valor_diaria,
            'km_inicial' => $request->km_inicial,
            'km_final' => $request->km_final
        ]);

        return response()->json($carrinho, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carrinho  $carrinho
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carrinho = $this->carrinho->find($id);
        if($carrinho === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        }

        return response()->json($carrinho, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carrinho  $carrinho
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrinho $carrinho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carrinho  $carrinho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $carrinho = $this->carrinho->find($id);

        if($carrinho === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($carrinho->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);

        } else {
            $request->validate($carrinho->rules());
        }

        $carrinho->fill($request->all());
        $carrinho->save();

        return response()->json($carrinho, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carrinho  $carrinho
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrinho = $this->carrinho->find($id);

        if($carrinho === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $carrinho->delete();
        return response()->json(['msg' => 'O produto foi removido do carrinho com sucesso!'], 200);

    }
}
