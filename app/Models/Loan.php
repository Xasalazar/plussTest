<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Loan
 *
 * @property $id
 * @property $executive_id
 * @property $book_id
 * @property $due_date
 * @property $created_at
 * @property $updated_at
 *
 * @property Book $book
 * @property Executive $executive
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Loan extends Model
{

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['reader_id', 'book_id', 'due_date'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function book()
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reader()
    {
        return $this->hasOne(Reader::class, 'id', 'reader_id');
    }
}
