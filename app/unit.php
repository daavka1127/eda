<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
  protected $table = 'tbunit';
  public $primaryKey = 'id';
  public $timestamps = false;
}
