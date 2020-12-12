<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\employee;
use App\mission;
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

        try{
            $rd = $req->rd;
            if($req->rd == ''){
                $msg = array(
                   'status' => 'rdError',
                   'msg' => 'Регистрийн дугаар хоосон байна!!!'
                );
                return $msg;
            }

            $checkedUser = employee::where('RD', '=', $req->rd)->get();

            if(count($checkedUser) == 0){
                if($req->rd != $req->old_rd){
                    $nrd = DB::delete('DELETE FROM tbemployee WHERE RD = "' . $req->old_rd . '"');
                }
                $emp = DB::table('tbemployee')
                    ->where('RD', '=', $req->old_rd);
                    $sexNumber = substr($req->rd, 10, 1);
                    if(($sexNumber%2) == 1){
                        $sex = "эр";
                    }
                    else if(($sexNumber%2) == 0){
                        $sex = "эм";
                    }
                    else{
                        $sex = "";
                    }
                $emp = new employee;
                $emp->RD = $req->rd;
                $emp->lastName = $req->lastName;
                $emp->firstname = $req->firstname;
                $sexNumber = substr($req->rd, 10, 1);
                if(($sexNumber%2) == 1){
                    $emp->sex = "эр";
                }
                else if(($sexNumber%2) == 0){
                    $emp->sex = "эм";
                }
                else{
                    $emp->sex = "";
                }
                $emp->unit = $req->unit;
                $emp->rank = $req->rankAlbanTushaal;
                $emp->date = date("Y/m/d h:i:s");
                $emp->admin = Auth::user()->id;
                $emp->save();

                if($req->rd != $req->old_rd){
                    $mission = mission::where('RD', '=', $req->old_rd)->update(['RD' => $req->rd]);
                }
            }
            else{
                if($req->rd != $req->old_rd){
                    $nrd = DB::delete('DELETE FROM tbemployee WHERE RD = "' . $req->old_rd . '"');
                }

                $emp = employee::find($req->rd);

                $emp->RD = $req->rd;
                $emp->lastName = $req->lastName;
                $emp->firstname = $req->firstname;
                $sexNumber = substr($req->rd, 10, 1);
                if(($sexNumber%2) == 1){
                    $emp->sex = "эр";
                }
                else if(($sexNumber%2) == 0){
                    $emp->sex = "эм";
                }
                else{
                    $emp->sex = "";
                }
                $emp->unit = $req->unit;
                $emp->rank = $req->rankAlbanTushaal;
                $emp->date = date("Y/m/d h:i:s");
                $emp->admin = Auth::user()->id;
                $emp->save();
            }

             $msg = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
             );
            return $msg;
        }catch(\Exception $e){
            $msg = array(
               'status' => 'error',
               'msg' => 'Серверийн алдаа гарлаа. Веб мастерт хандана уу!!!'
            );
            return $msg;
        }
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

    public function getEmptyRD(){
        $emptyRD = DB::table('tbemployee')
            ->select(DB::Raw('max(CAST(RD AS int)) as count'))
            ->whereRaw('LENGTH(RD) < 10')
            ->first();
        return $emptyRD->count + 1;
    }

    public function getEmpByRD(Request $req){
        $emp = DB::table('tbemployee')
            ->select('tbemployee.*')
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
