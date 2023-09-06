<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::with('section')->orderByDesc('rented_copies')
            ->orderBy('publication_date')
            ->orderBy('title');

        $categoria = $request->input('category');
        if (!empty($categoria)) {
            $books->whereHas('section', function ($query) use ($categoria) {
                $query->where('name', 'LIKE', '%' . $categoria . '%');
            });
        }

        $booksList = $books->paginate();


        return $this->sendResponse($booksList, 'Mensaje de Éxito', 200);
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
        $book = Book::create($request->all());
        return $this->sendResponse($book, 'Libro Creado Exitosamente', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('section')->find($id);
        if (!$book) {
            return $this->sendError('Libro no encontrado', [], 404);
        }
        return $this->sendResponse($book, 'Mensaje de Éxito', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return $this->sendError('Libro no encontrado', [], 404);
        }
        if ($validation = $this->validateRequest($request)) {
            return $validation;
        }
        $book->update($request->all());
        return $this->sendResponse($book, 'Libro Actualizado Exitosamente', 200);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return $this->sendError('Libro no encontrado', [], 404);
        }
        $book->delete();
        return $this->sendResponse($book, 'Libro Eliminado Exitosamente', 200);
    }

    #region Validacion
    protected function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_id' => 'required',
            'title' => 'required|max:30',
            'description' => 'required|min:15',
            'number_page' => 'required',
            'publication_date' => 'required|date|before_or_equal:' . now()->format('Y-m-d')
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            return $this->sendError('Error de Validación', $errors, 400);
        }
    }
    #endregion
}
