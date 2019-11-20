<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class awards extends Model
{
  protected $table = 'tbmissionawards';
  public $primaryKey = 'id';
  public $timestamps = false;
}
