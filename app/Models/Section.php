<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Section
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Book[] $books
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Section extends Model
{

  use HasFactory;

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'description'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function books()
  {
    return $this->hasMany(Book::class, 'section_id', 'id');
  }
}
