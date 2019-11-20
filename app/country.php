<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
  protected $table = 'tbcountry';
  public $primaryKey = 'id';
  public $timestamps = false;
}
