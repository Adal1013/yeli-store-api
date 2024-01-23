<?php

namespace App\Database\Eloquent;

use App\Models\Product;
use \Illuminate\Database\Eloquent\Collection;

class ProductEloquent
{
  /**
   * obtene datos de uno o mas modelos
   */
  public static function getDataModel() 
  {
     return Product::all();
  }
}
