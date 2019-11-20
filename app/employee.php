<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
  protected $table = 'tbemployee';
  public $primaryKey = 'RD';
  public $timestamps = false;
}
