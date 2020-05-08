<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->sendResponse(UserResource::collection($users),'Usuarios mostrados con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if(is_null($user)){
            return $this->sendError('Usuario no encontrado');
        }

        return $this->sendResponse(new UserResource($user), 'Usuario mostrado con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $dataInput = $request->all();

        $validator = Validator::make($dataInput, [
            'name' => 'required',
            'email' => 'email|required',
        ]);

        if($validator->fails()){
            return $this->sendError('Error en los campos', $validator->errors());
        }

        $user->update($dataInput);

        return $this->sendResponse(new UserResource($user), 'Usuario modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->sendResponse([], 'Usuario borrado con éxito');
    }
}
