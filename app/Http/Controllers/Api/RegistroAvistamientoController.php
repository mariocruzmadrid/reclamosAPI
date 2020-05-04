<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\RegistroAvistamiento;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RegistroAvistamiento as RegistroAvistamientoResource;

class RegistroAvistamientoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regAvistamiento = RegistroAvistamiento::all();

        return $this->sendResponse(RegistroAvistamientoResource::collection($regAvistamiento),'Registros avistamiento mostrados con éxito');
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
            'animal_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Campos incorrectos', $validator->errors(),400);
        }

        $regAvistamiento = RegistroAvistamiento::create($dataInput);

        return $this->sendResponse(new RegistroAvistamientoResource($regAvistamiento), 'Registro avistamiento creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regAvistamiento = RegistroAvistamiento::find($id);

        if(is_null($regAvistamiento)){
            return $this->sendError('Registro avistamiento no encontrado');
        }

        return $this->sendResponse(new RegistroAvistamientoResource($regAvistamiento), 'Registro avistamiento mostrado con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  RegistroAvistamiento $regAvistamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroAvistamiento $regAvistamiento)
    {
        $dataInput = $request->all();

        $validator = Validator::make($dataInput, [
            'date' => 'required',
            'animal_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Campos incorrectos', $validator->errors());
        }

        $regAvistamiento->date = $dataInput['date'];
        $regAvistamiento->animal_id = $dataInput['animal_id'];
        $regAvistamiento->user_id = $dataInput['user_id'];
        $regAvistamiento->save();

        return $this->sendResponse(new RegistroAvistamientoResource($regAvistamiento), 'Registro avistamiento modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RegistroAvistamiento $regAvistamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroAvistamiento $regAvistamiento)
    {
        $regAvistamiento->delete();

        return $this->sendResponse([], 'Registro avistamiento borrado con éxito');
    }
}
