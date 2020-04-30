<?php

namespace App\Http\Controllers\Api;

use App\Animal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Animal::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAnimal = $request->validate([
           'name'=>'required'
        ]);

        $animal = Animal::create($validatedAnimal);

        return response(['message'=>$animal]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::where('id','=',$id)->firstOrFail();

        return response(['message'=>$animal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedAnimal = $request->validate([
            'name'=>'required'
        ]);

        $animal = Animal::find($id);

        $animal->update($validatedAnimal);

        return response(['message'=>$animal]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);
        $animal->delete();

        return response(['message'=>$animal]);
    }
}
