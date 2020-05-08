<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Reclamo;
use Illuminate\Http\Request;
use App\Http\Resources\Reclamo as ReclamoResource;
use Illuminate\Support\Facades\Validator;

class ReclamoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reclamos = Reclamo::all();

        return $this->sendResponse(ReclamoResource::collection($reclamos),'Reclamos mostrados con éxito');
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
            'title' => 'required',
            'description' => 'required',
            'animal_id' => 'required',
            'reclamo' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Campos incorrectos', $validator->errors(),400);
        }

        $reclamo = new Reclamo;
        $reclamo->title = $dataInput['title'];
        $reclamo->descripcion = $dataInput['descripcion'];
        $reclamo->animal_id = $dataInput['animal_id'];
        $reclamo->url = $dataInput['reclamo']->store();

        return $this->sendResponse(new ReclamoResource($reclamo), 'Reclamo creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reclamo = Reclamo::find($id);

        if(is_null($reclamo)){
            return $this->sendError('Reclamo no encontrado');
        }

        return $this->sendResponse(new ReclamoResource($reclamo), 'Reclamo mostrado con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Reclamo  $reclamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reclamo $reclamo)
    {
        $dataInput = $request->all();

        $validator = Validator::make($dataInput, [
            'title' => 'required',
            'description' => 'required',
            'animal_id' => 'required',
            'url' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Campos incorrectos', $validator->errors());
        }

        var_dump($reclamo);

        return $this->sendResponse(new ReclamoResource($reclamo), 'Reclamo modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reclamo $reclamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reclamo $reclamo)
    {
        $reclamo->delete();

        return $this->sendResponse([], 'Reclamo borrado con éxito');
    }
}
