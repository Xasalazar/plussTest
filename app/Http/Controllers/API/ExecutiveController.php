<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Executive;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;

/**
 * Class ExecutiveController
 * @package App\Http\Controllers
 */
class ExecutiveController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $executives = Executive::paginate();
        return $this->sendResponse($executives, 'Mensaje de Éxito', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($validation = $this->validateRequest($request)) {
            return $validation;
        }
        $executive = Executive::create($request->only(['name', 'lastname', 'phone', 'document']));
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt('password'), // Cambia esto al valor deseado
            ]);
            $executive->user()->save($user);
        }
        return $this->sendResponse($executive, 'Ejecutivo Creado Exitosamente', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $executive = Executive::find($id);
        if (!$executive) {
            return $this->sendError('Ejecutivo no encontrado', [], 404);
        }
        return $this->sendResponse($executive, 'Mensaje de Éxito', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Executive $executive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Executive $executive, $id)
    {
        $executive = Executive::find($id);
        if (!$executive) {
            return $this->sendError('Ejecutivo no encontrado', [], 404);
        }
        if ($validation = $this->validateRequest($request)) {
            return $validation;
        }
        $executive->update($request->only(['name', 'lastname', 'phone', 'document']));
        return $this->sendResponse($executive, 'Ejecutivo Actualizado Exitosamente', 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $executive = Executive::find($id);
        if (!$executive) {
            return $this->sendError('Ejecutivo no encontrado', [], 404);
        }
        $user = $executive->user();

        if ($user) {
            $user->delete();
        }

        $executive->delete();
        return $this->sendResponse($executive, 'Ejecutivo Eliminado Exitosamente', 200);
    }

    #region Validacion
    protected function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'document' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->sendError('Error de Validación', $errors, 400);
        }
    }
    #endregion
}
