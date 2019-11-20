<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class training extends Model
{
  protected $table = 'tbtraining';
  public $primaryKey = 'id';
  public $timestamps = false;
}
