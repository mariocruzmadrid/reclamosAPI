<?php

namespace App\Http\Controllers\Api;

use App\Animal;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Animal as AnimalResource;
use Illuminate\Support\Facades\Validator;

class AnimalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::all();

        return $this->sendResponse(AnimalResource::collection($animals),'Animales mostrados con éxito');
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
           'name'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Error en los campos', $validator->errors(),400);
        }

        $animal = Animal::create($dataInput);

        return $this->sendResponse(new AnimalResource($animal), 'Animal creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::find($id);

        if(is_null($animal)){
            return $this->sendError('Animal no encontrado');
        }

        return $this->sendResponse(new AnimalResource($animal), 'Animal mostrado con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        $dataInput = $request->all();

        $validator = Validator::make($dataInput, [
           'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Error en los campos', $validator->errors());
        }

        $animal->update($dataInput);

        return $this->sendResponse(new AnimalResource($animal), 'Animal modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return $this->sendResponse([], 'Animal borrado con éxito');
    }
}
