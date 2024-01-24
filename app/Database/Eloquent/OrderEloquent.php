<?php

namespace App\Database\Eloquent;

use App\Models\Order;

class OrderEloquent
{
  /**
   * obtene datos de uno o mas modelos
   */
  public static function getDataModel() 
  {
     return Order::all();
  }
}
