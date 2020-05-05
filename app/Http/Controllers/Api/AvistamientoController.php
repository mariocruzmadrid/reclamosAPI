<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Avistamiento;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Avistamiento as AvistamientoResource;

class AvistamientoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avistamiento = Avistamiento::all();

        return $this->sendResponse(AvistamientoResource::collection($avistamiento),'Avistamientos mostrados con éxito');
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

        $avistamiento = Avistamiento::create($dataInput);

        return $this->sendResponse(new AvistamientoResource($avistamiento), 'Avistamiento creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $avistamiento = Avistamiento::find($id);

        if(is_null($avistamiento)){
            return $this->sendError('Avistamiento no encontrado');
        }

        return $this->sendResponse(new AvistamientoResource($avistamiento), 'Avistamiento mostrado con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Avistamiento $avistamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avistamiento $avistamiento)
    {
        $dataInput = $request->all();

        $validator = Validator::make($dataInput, [
            'date' => 'required',
            'animal_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Campos incorrectos', $validator->errors());
        }

        $avistamiento->update($dataInput);

        return $this->sendResponse(new AvistamientoResource($avistamiento), 'Avistamiento modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Avistamiento $avistamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avistamiento $avistamiento)
    {
        $avistamiento->delete();

        return $this->sendResponse([], 'Avistamiento borrado con éxito');
    }
}
