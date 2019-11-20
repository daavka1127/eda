<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\employee;
use Illuminate\Support\Facades\Auth;

class missionByemployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showEmpReport($rd){
        $empRow = DB::table('tbemployee')
            ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
            ->where('tbemployee.RD', '=', $rd)
            ->select('tbemployee.*', 'tbunit.unit as unitName')
            ->first();
        $missions = DB::table('tbmission')
            ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
            ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
            ->join('users', 'tbmission.admin', '=', 'users.id')
            ->select('tbcountry.countryName', 'tbmission.eelj', 'tbsector.sectorName', 'tbrank.RankName', 'tbmission.operationRank', 'tbmission.date', 'users.name')
            ->where('tbmission.RD', '=', $rd)
            ->get();
        $awards = DB::table('tbmissionawards')
            ->join('tbcountry', 'tbmissionawards.country', '=', 'tbcountry.id')
            ->join('users', 'tbmissionawards.admin', '=', 'users.id')
            ->select('tbcountry.countryName', 'tbmissionawards.eelj', 'tbmissionawards.tailbar', 'tbmissionawards.date', 'users.name')
            ->where('tbmissionawards.RD', '=', $rd)
            ->get();
        $punishments = DB::table('tbmissionpunishment')
            ->join('tbcountry', 'tbmissionpunishment.country', '=', 'tbcountry.id')
            ->join('users', 'tbmissionpunishment.admin', '=', 'users.id')
            ->select('tbcountry.countryName', 'tbmissionpunishment.eelj', 'tbmissionpunishment.tailbar', 'tbmissionpunishment.date', 'users.name')
            ->where('tbmissionpunishment.RD', '=', $rd)
            ->get();
        $trainings = DB::table('tbtraining')
            ->join('tbemployee', 'tbtraining.RD', '=', 'tbemployee.RD')
            ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
            ->join('tbtrainingtype', 'tbtraining.trainingType', '=', 'tbtrainingtype.id')
            ->join('users', 'tbtraining.admin', '=', 'users.id')
            ->select('tbtrainingtype.trainingTypeName', 'tbtraining.trainingCoutnry',
            'tbtraining.trainingName', 'tbtraining.leaveDate', 'tbtraining.arriveDate',
            'tbtraining.date', 'users.name', 'tbunit.unit')
            ->where('tbtraining.RD', '=', $rd)
            ->get();
        $date = date("Y/m/d");
        $dateArr = explode("/", $date);
        $dateString = $dateArr[0] . " оны " . $dateArr[1] . " " . $this->getDugaarText($dateArr[1]) . " сарын " . $dateArr[2] . " " . $this->getDayText($dateArr[2]) . " өдөр";
        return view('reports.empDetailsReport', compact('dateString', 'empRow', 'missions', 'awards', 'punishments', 'trainings'));
    }

    public function getDugaarText($month){
        if($month == 1 || $month == 4 || $month == 9 || $month == 11){
            return "дүгээр";
        }
        else{
            return "дугаар";
        }
    }

    public function getDayText($date){
        $lastNumber = $date % 10;
        if($lastNumber == 1 || $lastNumber == 4 || $lastNumber == 9 || $lastNumber == 11){
            return "ний";
        }
        else{
            return "ны";
        }
    }
}
