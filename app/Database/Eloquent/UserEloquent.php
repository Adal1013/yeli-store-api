<?php

namespace App\Database\Eloquent;

use App\Models\User;
use \Illuminate\Database\Eloquent\Collection;

class UserEloquent
{
  /**
   * obtene datos de uno o mas modelos
   */
  public static function getDataModel() 
  {
     return User::all();
  }
}
