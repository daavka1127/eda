<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\operation;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class operationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $operations = DB::table('tbajillagaa')
            ->join('tbcountry', 'tbajillagaa.country', '=', 'tbcountry.id')
            ->select('tbajillagaa.*', 'tbcountry.countryName')
            ->get();
        return view('ajillagaa.oprationShow', compact('operations'));
    }

    public function store(Request $req){
        try{
            $operation = DB::table('tbajillagaa')
                ->where('country', '=', $req->country)
                ->where('eelj', '=', $req->eelj)
                ->get();
            $rowCount = $operation->count();
            if($rowCount > 0){
                $array = array(
                    'status' => 'exist',
                    'msg' => 'Ээлж бүртгэлтэй байна!!!'
                );
                return $array;
            }
            $operation = new operation;
            $operation->country = $req->country;
            $operation->eelj = $req->eelj;
            $parts = explode('/',$req->leaveDate);
            $date1 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $parts = explode('/',$req->arriveDate);
            $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $operation->leaveDate = date('Y-m-d', strtotime($date1));
            $operation->arriveDate = date('Y-m-d', strtotime($date2));
            $operation->save();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }

    }

    public function update(Request $req){
        try{
            $operation = operation::find($req->operationID);
            $operation->country = $req->country;
            $operation->eelj = $req->eelj;
            $parts = explode('/',$req->leaveDate);
            $date1 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $parts = explode('/',$req->arriveDate);
            $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $operation->leaveDate = date('Y-m-d', strtotime($date1));
            $operation->arriveDate = date('Y-m-d', strtotime($date2));
            $operation->save();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }

    }

    public function delete(Request $request){
        try{
            $operation = operation::find($request->operationID);
            $operation->delete();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай устгалаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }

    public function checkOperationNew(Request $request){
        $operation = DB::table('tbajillagaa')
            ->where('country', '=', $request->country)
            ->where('eelj', '=', $request->eelj)
            ->get();
        $rowCount = $operation->count();
        return $rowCount;
    }

    public function checkOperationEdit(Request $request){
        $operation = DB::table('tbajillagaa')
            ->where('country', '=', $request->country)
            ->where('eelj', '=', $request->eelj)
            ->get();
        $rowCount = $operation->count();
        return $rowCount;
    }

    public function getEelj(Request $req){
        $eeljs = DB::table('tbajillagaa')
            ->where('country', '=', $req->country)
            ->pluck('id', 'eelj');
        return $eeljs;
    }
}
