<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Imports\EmpMissionImport;
use Maatwebsite\Excel\Facades\Excel;
use App\rank;

class excelController extends Controller
{
    public function showExcel(){
        $countries = DB::table('tbcountry')->get();
        return view('excelImport.importExcel', compact('countries'));
    }

    public function importExcel(Request $req){
        $country = $req->country;
        $eelj = $req->eelj;
        $import = new EmpMissionImport($req->country, $req->eelj);
        $import->country = $req->country;
        $import->eelj = $req->eelj;
        Excel::import($import,$req->fileExcel);
        $errors = DB::table('tberrorexcel')->get();
        $countries = DB::table('tbcountry')->get();
        return view('excelImport.importExcel', compact('errors', 'countries'));

    }
}
