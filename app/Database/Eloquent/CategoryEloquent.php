<?php

namespace App\Database\Eloquent;

use App\Models\Category;
use \Illuminate\Database\Eloquent\Collection;

class CategoryEloquent
{
  /**
   * obtene datos de uno o mas modelos
   */
  public static function getDataModel() 
  {
     return Category::all();
  }
}
