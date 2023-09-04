<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @property $id
 * @property $section_id
 * @property $title
 * @property $description
 * @property $number_page
 * @property $publication_date
 * @property $created_at
 * @property $updated_at
 *
 * @property Section $section
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Book extends Model
{
  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['section_id', 'title', 'description', 'number_page', 'publication_date', 'available'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function section()
  {
    return $this->hasOne(Section::class, 'id', 'section_id');
  }
}
