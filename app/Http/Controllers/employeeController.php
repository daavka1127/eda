<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\employee;
use Response;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class employeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $req){
        $emp = new employee;
        $emp->RD = $req->RD;
        $emp->lastName = $req->lastName;
        $emp->firstname = $req->firstname;
        $emp->unit = $req->unit;
        $emp->rank = $req->rank;
        $emp->save();
    }

    public static function storeFromExcel($RD, $lastName, $firstname, $sex, $unit, $rank){
        $emp = new employee;
        $emp->RD = $RD;
        $emp->lastName = $lastName;
        $emp->firstname = $firstname;
        $emp->sex = $sex;
        $emp->unit = $unit;
        $emp->rank = $rank;
        $emp->date = date("Y/m/d h:i:s");
        $emp->admin = Auth::user()->id;
        $emp->save();
    }

    public function update(Request $req){
        $emp = employee::find($req->old_rd);
        $emp->RD = $req->RD;
        $emp->lastName = $req->lastName;
        $emp->firstname = $req->firstname;
        $emp->unit = $req->unit;
        $emp->rank = $req->rank;
        $emp->date = date("Y/m/d h:i:s");
        $emp->admin = Auth::user()->id;
        $emp->save();
    }

    public static function updateFromExcel($RD, $lastName, $firstname, $sex, $unit, $rank){
        $emp = employee::find($RD);
        $emp->lastName = $lastName;
        $emp->firstname = $firstname;
        $emp->sex = $sex;
        $emp->unit = $unit;
        $emp->rank = $rank;
        $emp->date = date("Y/m/d h:i:s");
        $emp->admin = Auth::user()->id;
        $emp->save();
    }

    public function delete(Request $req){
        $emp = employee::find($req->RD);
        $emp->delete();
    }

    public function checkRD(Request $req){
        $emp = employee::find($req->RD);
        return $emp->count();
    }

    public function getEmpByRD(Request $req){
        $emp = DB::table('tbemployee')
            ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
            ->select('tbemployee.*', 'tbunit.unit as unitNumber')
            ->where('RD', '=', $req->register)
            ->get();
        return Response::json($emp);
    }

    public function getNameRd(Request $req){
        $emp = DB::table('tbemployee')
            ->join('tbmission', 'tbemployee.RD', '=', 'tbmission.RD')
            ->select('tbmission.RD', 'tbemployee.lastName', 'tbemployee.firstname')
            ->where('tbmission.country', '=', $req->country)
            ->where('tbmission.eelj', '=', $req->eelj)
            ->get();
        return DataTables::of($emp)
            ->make(true);
    }
}
