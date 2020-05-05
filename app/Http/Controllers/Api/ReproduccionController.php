<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Reproduccion;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Reproduccion as ReproduccionResource;

class ReproduccionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reproduccion = Reproduccion::all();

        return $this->sendResponse(ReproduccionResource::collection($reproduccion),'Registro reproducciones mostrados con éxito');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataInput = $request->all();

        $validator = Validator::make($dataInput, [
            'date' => 'required',
            'reclamo_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Campos incorrectos', $validator->errors(),400);
        }

        $reproduccion = Reproduccion::create($dataInput);

        return $this->sendResponse(new ReproduccionResource($reproduccion), 'Registro reproduccion creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reproduccion = Reproduccion::find($id);

        if(is_null($reproduccion)){
            return $this->sendError('Registro reproduccion no encontrado');
        }

        return $this->sendResponse(new ReproduccionResource($reproduccion), 'Registro reproduccion mostrado con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Reproduccion $reproduccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reproduccion $reproduccion)
    {
        $dataInput = $request->all();

        $validator = Validator::make($dataInput, [
            'date' => 'required',
            'reclamo_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Campos incorrectos', $validator->errors());
        }

        $reproduccion->update($dataInput);

        return $this->sendResponse(new ReproduccionResource($reproduccion), 'Registro reproduccion modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reproduccion $reproduccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reproduccion $reproduccion)
    {
        $reproduccion->delete();

        return $this->sendResponse([], 'Registro reproduccion borrado con éxito');
    }
}
