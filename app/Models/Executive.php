<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Executive
 *
 * @property $id
 * @property $name
 * @property $lastname
 * @property $phone
 * @property $document
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Executive extends Model
{
  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'lastname', 'phone', 'document'];

  public function user()
  {
    return $this->morphOne(User::class, 'role');
  }
}
