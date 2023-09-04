<?php

namespace App\Http\Controllers\API;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;


/**
 * Class SectionController
 * @package App\Http\Controllers
 */
class SectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::paginate();
        return $this->sendResponse($sections, 'Mensaje de Éxito', 200);
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
        $section = Section::create($request->all());

        return $this->sendResponse($section, 'Seccion Creado Exitosamente', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        if (!$section) {
            return $this->sendError('Seccion no encontrado', [], 404);
        }
        return $this->sendResponse($section, 'Mensaje de Éxito', 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section, $id)
    {

        $section = Section::find($id);
        if (!$section) {
            return $this->sendError('Seccion no encontrado', [], 404);
        }
        if ($validation = $this->validateRequest($request)) {
            return $validation;
        }
        $section->update($request->all());
        return $this->sendResponse($section, 'Seccion Actualizado Exitosamente', 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        if (!$section) {
            return $this->sendError('Seccion no encontrado', [], 404);
        }
        $section->delete();
        return $this->sendResponse($section, 'Seccion Eliminado Exitosamente', 200);
    }



    #region Validacion
    protected function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->sendError('Error de Validación', $errors, 400);
        }
    }
    #endregion
}
