<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mission;
use App\employee;
use App\Http\Controllers\employeeController;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class missionController extends Controller
{
    private $employee;
    public function __construct()
    {
        $this->employee = new employeeController();
        $this->middleware('auth');
    }

    public function show(){
        $countries = DB::table('tbcountry')
            ->get();
        $rankTypes = DB::table('tbranktype')
            ->get();
        $units = DB::table('tbunit')
            ->orderby('id', 'ASC')
            ->get();
        return view('mission.missionShow', compact('countries', 'rankTypes', 'units'));
    }

    public function store(Request $req){
        // try{
            $rd = $req->rd;
            if($req->rd == ''){
                $rd = $this->employee->getEmptyRD();
            }

            $insert = true;
            $emp = employee::where('RD', $rd);
            $emp = DB::table('tbemployee')->where('RD', '=', $rd)->get();

            if(count($emp) > 0){
                $insert = false;
            }

            if($insert)
            {
                $emp = new employee;
                $emp->RD = $rd;
                $emp->lastName = $req->lastName;
                $emp->firstname = $req->firstname;
                $sexNumber = substr($req->rd, 10, 1);
                if(($sexNumber%2) == 1){
                    $emp->sex = "эр";
                }
                if(($sexNumber%2) == 2){
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



            $mission = new mission;
            $mission->RD = $rd;
            $mission->country = $req->country;
            $mission->eelj = $req->eelj;
            $mission->rank = $req->rank;
            $mission->operationRank = $req->operationRank;
            $mission->date = date("Y/m/d h:i:s");
            $mission->admin = Auth::user()->id;
            $mission->save();

            return "Амжилттай хадгаллаа";
        // } catch(\Exception $e){
        //   return "Алдаа гарлаа!!!";
        // }
    }

    public function update(Request $req){
        // try{
            $rd = $req->rd;
            if($req->rd == ''){
                $msg = array(
                   'status' => 'rdError',
                   'msg' => 'Регистрийн дугаар хоосон байна!!!'
                );
                return $msg;
            }

            // return $req->old_rd;
            $checkedUser = employee::where('RD', '=', $req->rd)->get();
            // $checkedUserOld = employee::where('RD', '=', $req->old_rd)->get();
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
                // $emp = DB::table('tbemployee')
                //     ->where('RD', '=', $req->old_rd)

                // $emp = employee::where('RD', '=', $req->old_rd)
                //     ->update([
                //       'RD' => $req->rd,
                //       'lastName' => $req->lastName,
                //       'firstname' => $req->firstname,
                //       'sex' => $sex,
                //       'unit' => $req->unit,
                //       'rank' => $req->rankAlbanTushaal,
                //       'date' => date("Y/m/d h:i:s"),
                //       'admin' => Auth::user()->id
                //     ]);
            }
            // else if(count($checkedUser) == 0 && )
            else{
                // $emp = employee::find($req->old_rd);
                // $emp->delete();
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




            if($req->rd != $req->old_rd){
                $mission = mission::where('RD', '=', $req->old_rd)->update(['RD' => $req->rd]);
            }

            $mission = mission::find($req->hideMissionId);
            $mission->country = $req->country;
            $mission->eelj = $req->eelj;
            // $mission->sector = $req->sector;
            $mission->rankType = $req->rankType;
            $mission->rank = $req->rank;
            $mission->operationRank = $req->operationRank;
            $mission->date = date("Y/m/d h:i:s");
            $mission->admin = Auth::user()->id;
            $mission->save();

             $msg = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
             );
            return $msg;
        // }catch(\Exception $e){
        //     $msg = array(
        //        'status' => 'error',
        //        'msg' => 'Серверийн алдаа гарлаа. Веб мастерт хандана уу!!!'
        //     );
        //     return $msg;
        // }
    }

    public static function storeFromExcel($RD, $country, $eelj, $rank, $operationRank){
        $mission = new mission;
        $mission->RD = $RD;
        $mission->country = $country;
        $mission->eelj = $eelj;
        // $mission->sector = $sector;
        // $mission->rankType = $rankType;
        $mission->rank = $rank;
        $mission->operationRank = $operationRank;
        $mission->date = date("Y/m/d h:i:s");
        $mission->admin = Auth::user()->id;
        $mission->save();
    }

    public static function updateFromExcel($RD, $country, $eelj, $rank, $operationRank){
        $mission = mission::where('RD', $RD)->where('country', $country)->where('eelj', $eelj);
        $mission->country = $country;
        $mission->eelj = $eelj;
        $mission->sector = $sector;
        $mission->rankType = $rankType;
        $mission->rank = $rank;
        $mission->operationRank = $operationRank;
        $mission->date = date("Y/m/d h:i:s");
        $mission->admin = Auth::user()->id;
        $mission->save();
    }

    public function delete(Request $req){
        try{
            $mission = mission::find($req->id);
            $mission->delete();
            return "Амжилттай устгалаа.";
        }catch(\Excaption $e){return "00";}
    }

    public function getEmpMission(Request $req){
        $emps = DB::table('tbmission')
            ->join('tbemployee', 'tbmission.RD', '=', 'tbemployee.RD')
            ->join('users', 'tbmission.admin', '=', 'users.id')
            ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
            // ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->select('tbmission.*', 'tbmission.rank as rankCode', 'tbemployee.lastName', 'tbemployee.firstname', 'tbemployee.rank', 'tbemployee.unit as unitID',
            'tbemployee.unit', 'users.name', 'tbcountry.countryName',
            DB::raw('(select COUNT(*) FROM tbmission as t1 WHERE t1.RD = tbmission.RD) as countOp'))
            ->where('tbmission.country', '=', $req->country)
            ->where('tbmission.eelj', '=', $req->eelj)
            // ->offset($req->length)
            // ->limit($req->start)
            ->get();
        return DataTables::of($emps)
            ->addColumn('readMore', '<input type="button" onclick=readmoreMisstionByEmp("{{$RD}}") value="Дэлгэрэнгүй" />')
            ->rawColumns(['readMore'])
            ->make(true);
    }

    public function getMissionByRD(Request $req){
        $missions = DB::table('tbmission')
            ->join('users', 'tbmission.admin', '=', 'users.id')
            ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
            // ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->select('tbmission.*', 'tbmission.rank as rankCode', 'users.name',
            'tbcountry.countryName')
            ->where('tbmission.RD', '=', $req->rd)
            ->get();
        return DataTables::of($missions)
            ->make(true);
    }

    public function checkMissionEmp(Request $req){
        $missionEmp = DB::table('tbmission')
            ->where('tbmission.RD', '=', $req->rd)
            ->where('tbmission.country', '=', $req->country)
            ->where('tbmission.eelj', '=', $req->eelj)
            ->count();
        return $missionEmp;
    }

    public function deleteEmpByEelj(Request $req){
        try{
            $missionEmp = DB::table('tbmission')
                ->where('country', '=', $req->countryID)
                ->where('eelj', '=', $req->eelj);
            $missionEmp->delete();
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


}
