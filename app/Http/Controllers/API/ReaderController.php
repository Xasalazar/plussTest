<?php

namespace App\Http\Controllers\API;

use App\Models\Reader;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;

/**
 * Class ReaderController
 * @package App\Http\Controllers
 */
class ReaderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = Reader::paginate();
        return $this->sendResponse($readers, 'Mensaje de Éxito', 200);
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
        $reader = Reader::create($request->only(['name', 'lastname', 'phone', 'document']));
        return $this->sendResponse($reader, 'Lector Creado Exitosamente', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($document)
    {
        $reader = Reader::where('document', $document)->first();
        if (!$reader) {
            return $this->sendError('Lector no encontrado', [], 404);
        }
        return $this->sendResponse($reader, 'Lector Encontrado con Éxito', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Executive $executive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reader $reader, $id)
    {
        $reader = Reader::find($id);
        if (!$reader) {
            return $this->sendError('Lector no encontrado', [], 404);
        }
        if ($validation = $this->validateRequest($request)) {
            return $validation;
        }
        $reader->update($request->only(['name', 'lastname', 'phone', 'document']));
        return $this->sendResponse($reader, 'Lector Actualizado Exitosamente', 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $reader = Reader::find($id);
        if (!$reader) {
            return $this->sendError('Lector no encontrado', [], 404);
        }
        $reader->delete();
        return $this->sendResponse($reader, 'Lector Eliminado Exitosamente', 200);
    }

    #region Validacion
    protected function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:15',
            'lastname' => 'required|max:15',
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
