<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mission;
use App\employee;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class missionController extends Controller
{
    public function __construct()
    {
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
        try{
            if($req->inserOrUpdate == "1")
            {
                $emp = new employee;
                $emp->RD = $req->rd;
                $emp->lastName = $req->lastName;
                $emp->firstname = $req->firstname;
                $sexNumber = substr($req->rd, 10, 1);
                if(($sexNumber%2) == 1){
                    $emp->sex = "эр";
                }
                else{
                    $emp->sex = "эм";
                }
                $emp->unit = $req->unit;
                $emp->rank = $req->rankAlbanTushaal;
                $emp->date = date("Y/m/d h:i:s");
                $emp->admin = Auth::user()->id;
                $emp->save();
            }

            $mission = new mission;
            $mission->RD = $req->rd;
            $mission->country = $req->country;
            $mission->eelj = $req->eelj;
            // $mission->sector = $req->sector;
            $mission->rankType = $req->rankType;
            $mission->rank = $req->rank;
            $mission->operationRank = $req->operationRank;
            $mission->date = date("Y/m/d h:i:s");
            $mission->admin = Auth::user()->id;
            $mission->save();

            return "Амжилттай хадгаллаа";
        } catch(\Exception $e){
          return "Алдаа гарлаа!!!";
        }
    }

    public function update(Request $req){
        try{
            $emp = employee::find($req->old_rd);
            $emp->RD = $req->rd;
            $emp->lastName = $req->lastName;
            $emp->firstname = $req->firstname;
            $sexNumber = substr($req->rd, 10, 1);
            if(($sexNumber%2) == 1){
                $emp->sex = "эр";
            }
            else{
                $emp->sex = "эм";
            }
            $emp->unit = $req->unit;
            $emp->rank = $req->rankAlbanTushaal;
            $emp->date = date("Y/m/d h:i:s");
            $emp->admin = Auth::user()->id;
            $emp->save();

            $mission = mission::find($req->id);
            $mission->RD = $req->rd;
            $mission->country = $req->country;
            $mission->eelj = $req->eelj;
            // $mission->sector = $req->sector;
            $mission->rankType = $req->rankType;
            $mission->rank = $req->rank;
            $mission->operationRank = $req->operationRank;
            $mission->date = date("Y/m/d h:i:s");
            $mission->admin = Auth::user()->id;
            $mission->save();
            return "Амжилттай заслаа";
        }catch(\Excaption $e){return "00";}
    }

    public static function storeFromExcel($RD, $country, $eelj, $sector, $rankType, $rank, $operationRank){
        $mission = new mission;
        $mission->RD = $RD;
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

    public static function updateFromExcel($RD, $country, $eelj, $sector, $rankType, $rank, $operationRank){
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
            ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
            ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
            ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
            ->join('users', 'tbmission.admin', '=', 'users.id')
            ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
            ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->select('tbmission.*', 'tbmission.rank as rankCode', 'tbemployee.lastName', 'tbemployee.firstname', 'tbemployee.rank', 'tbemployee.unit as unitID',
            'tbunit.unit', 'users.name', 'tbrank.RankName', 'tbcountry.countryName', 'tbsector.sectorName',
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
            ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
            ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
            ->join('users', 'tbmission.admin', '=', 'users.id')
            ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
            ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->select('tbmission.*', 'tbmission.rank as rankCode', 'users.name', 'tbrank.RankName',
            'tbcountry.countryName', 'tbsector.sectorName')
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


}
