<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Reader;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Carbon\Carbon;

/**
 * Class LoanController
 * @package App\Http\Controllers
 */
class LoanController extends BaseController
{
    public function rent(Request $request, $bookId, $readerId)
    {
        $book = Book::find($bookId);
        if (!$book) {
            return $this->sendError('Libro no encontrado', [], 404);
        }
        if (!$book->available) {
            return $this->sendError('Libro ya fue rentado', [], 404);
        }
        $reader = Reader::find($readerId);
        if (!$reader) {
            return $this->sendError('Lector no encontrado', [], 404);
        }

        $loan = new Loan([
            'reader_id' => $reader->id,
            'book_id' => $book->id,
            'due_date' => Carbon::now()->addDays(15),
        ]);
        $loan->save();

        // Actualizar el estado del libro a no disponible
        $book->update(['available' => false]);
        return $this->sendResponse($loan, 'Renta de Éxito', 200);
    }
}
