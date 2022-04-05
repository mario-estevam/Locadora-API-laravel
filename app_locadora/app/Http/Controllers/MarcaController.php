<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class MarcaController extends Controller
{

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Marca[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index() //get all
    {
        //
        $marcas = $this->marca->all();
        return  response()->json($marcas, 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate($this->marca->rules(),$this->marca->feedbacks());

        $marcas = $this->marca->create($request->all());
       return response()->json($marcas, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show( $id) //get by id
    {
        //
        $marca = $this->marca->find($id);
        if($marca === null){
            return response()->json(['error'=>'Recurso pesquisado não existe'], 404) ;
        }
        return response()->json($marca, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|string[]
     */
    public function update(Request $request, $id)
    {
        $marca = $this->marca->find($id);

        if($marca === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        $request->validate($marca->rules(), $marca->feedbacks());
        $marca->update($request->all());
        return response()->json($marca, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|string[]
     */
    public function destroy($id)
    {
        //
        $marca = $this->marca->find($id);
        if($marca === null){
            return response()->json(['error'=>'Recurso pesquisado não existe'], 404) ;
        }
        $marca->delete();
        return response()->json(['msg'=>'A marca foi removida com sucesso'], 200);
    }
}
