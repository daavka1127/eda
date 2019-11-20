<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pdfUpload extends Model
{
    protected $table = 'tbPdf';
    public $primaryKey = 'id';
    public $timestamps = false;
}
