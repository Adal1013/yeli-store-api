<?php

namespace App\Database\Eloquent;

use App\Models\Role;

class RoleEloquent
{
  /**
   * obtene datos de uno o mas modelos
   */
  public static function getDataModel() 
  {
     return Role::all();
  }
}
