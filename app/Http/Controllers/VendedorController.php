<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Vendedor;
use Illuminate\Http\Request;
use App\Repositories\VendedorRepository;

class VendedorController extends Controller
{

    public function __construct(Vendedor $vendedor) {
        $this->vendedor = $vendedor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $vendedorRepository = new VendedorRepository($this->vendedor);

        if($request->has('atributos_teste')){
            $atributos_teste = 'teste:id,'.$request->atributos_teste;
            $vendedorRepository->selectAtributosRegistrosRelacionados($atributos_teste);
        }

        else{
            $vendedorRepository->selectAtributosRegistrosRelacionados('teste');
        }

        if($request->has('filtro')){
            $vendedorRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $vendedorRepository->selectAtributos($request->atributos);
        }

        return response()->json($vendedorRepository->getResultado(), 200);
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
        $request->validate($this->vendedor->rules());

        $imagem = $request->file('imagem');
       $imagem_urn = $imagem->store('imagens_Tag/vendedor', 'public');

        $vendedor = $this->vendedor->create([
            'teste_id' => $request->teste_id,
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs
        ]);

         return response()->json($vendedor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendedor = $this->vendedor->with('teste')->find($id);
        if($vendedor === null){
            return response()->json(['erro' => 'Recurso pesquisado não exite'], 404);
        }
        return response()->json($vendedor, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendedor = $this->vendedor->find($id);

        if($vendedor === null){
          return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            return ['Verbo PATCH'];

            $regrasDinamicas = array();

            foreach($vendedor->rules() as $input => $regra) {

              if(array_key_exists($input, $request->all())) {
                  $regrasDinamicas[$input] = $regra;
              }
            }
            //dd($regrasDinamicas);

            $request->validate($regrasDinamicas);
        }

        else{
          $request->validate($vendedor->rules());
        }

        //remove o arquivo antigo caso um novo tenha sido enviado
        if($request->file('imagem')) {
          Storage::disk('public')->delete($vendedor->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens_Tag/vendedor', 'public');

        $vendedor->fill($request->all());
        $vendedor->imagem = $imagem_urn;
        $vendedor->save();

    //     $vendedor->update([
    //         'teste_id' => $request->teste_id,
    //         'nome' => $request->nome,
    //         'imagem' => $imagem_urn,
    //         'numero_portas' => $request->numero_portas,
    //         'lugares' => $request->lugares,
    //         'air_bag' => $request->air_bag,
    //         'abs' => $request->abs
    //   ]);

        return response()->json($vendedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendedor = $this->vendedor->find($id);

        if($vendedor === null){
          return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

         //remove o arquivo antigo caso um novo tenha sido enviado
         Storage::disk('public')->delete($vendedor->imagem);

        $vendedor->delete();
        return response()->json(['msg' => 'O vendedor foi removido com sucesso!'], 200);
      }
    }


