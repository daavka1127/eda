<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use App\errorExcel;
use Illuminate\Support\Facades\Auth;
use App\rank;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\missionController;

class EmpMissionImport implements ToCollection
{
    public $country=null, $eelj=null, $rankID1=null;
    private $employee;

    public function __construct($country, $eelj)
    {
        $this->country = $country;
        $this->eelj = $eelj;
        $this->employee = new employeeController();
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $i=0;
        errorExcel::query()->truncate();
        $tailbar = "";
        $rankType = "";
        $rankID="";
        $unitID="";
        $sectorID ="";
        foreach ($rows as $row) {
            if($i>0){

                if($tailbar == ""){
                  $rd = trim($row[0], " ");
                  $rd = str_replace(' ', '', $rd);
                  $rd = mb_substr($rd, 0, 10);
                  $rd1 = $rd;
                  if($rd1 == ''){
                      $rd = $this->employee->getEmptyRD();
                  }

                  $emps = DB::table("tbemployee")
                      ->where('tbemployee.RD', '=', $rd)
                      ->get();


                    if($rd1 != ''){
                        if(count($emps) == 0){
                            employeeController::storeFromExcel($rd, trim($row[1], " "), trim($row[2], " "), trim($row[3], " "), trim($row[4], " "), trim($row[5], " "));
                        }
                        else{
                            // return $rd;
                            employeeController::updateFromExcel($rd, trim($row[1], " "), trim($row[2], " "), trim($row[3], " "), trim($row[4], " "), trim($row[5], " "));
                        }
                        $missions = DB::table("tbmission")
                            ->where('tbmission.RD', '=', $rd)
                            ->where('tbmission.country', $this->country)
                            ->where('tbmission.eelj', $this->eelj)
                            ->get();
                        if(count($missions) == 0){
                            missionController::storeFromExcel($rd, $this->country, $this->eelj, trim($row[7], " "), trim($row[8], " "));
                        }
                    }
                    else{
                      $missions = DB::table("tbemployee")
                          ->join('tbmission', 'tbmission.RD', '=', 'tbemployee.RD')
                          ->where('tbmission.country', $this->country)
                          ->where('tbmission.eelj', $this->eelj)
                          ->where('tbemployee.lastName', '=', trim($row[1], " "))
                          ->where('tbemployee.firstname', '=', trim($row[2], " "))
                          ->where('tbemployee.sex', '=', trim($row[3], " "))
                          ->where('tbemployee.unit', '=', trim($row[4], " "))
                          ->where('tbemployee.rank', '=', trim($row[5], " "))
                          ->get();
                      if(count($missions) == 0){
                          employeeController::storeFromExcel(trim($rd, " "), trim($row[1], " "), trim($row[2], " "), trim($row[3], " "), trim($row[4], " "), trim($row[5], " "));
                          missionController::storeFromExcel($rd, $this->country, $this->eelj, trim($row[7], " "), trim($row[8], " "));
                      }
                    }


                }
                else{
                  $excel = new errorExcel;
                  $excel->RD = $row[0];
                  $excel->ovog = $row[1];
                  $excel->ner = $row[2];
                  $excel->huis = $row[3];
                  $excel->unit = $row[4];
                  $excel->albanTushaal = $row[5];
                  $excel->uls = $this->country;
                  $excel->eelj = $this->eelj;
                  $excel->tsol = $row[7];
                  $excel->a_alban_tushaal = $row[8];
                  $excel->tailbar = $tailbar;
                  $excel->save();
                }

            }
            $tailbar = "";
            $rankType = "";
            $rankID="";
            $unitID="";
            $sectorID ="";
            $rankID1=$row[7];
            $i++;
        }
    }

    public function checkUnit($unit){
        $units = DB::table('tbunit')
            ->where('tbunit.unit', '=', $unit)
            ->get();
        if(count($units) == 0){
            return 0;
        }
        else{
          $units = DB::table('tbunit')
              ->where('tbunit.unit', '=', $unit)
              ->first();
            return $units->id;
        }
    }

    public function checkSector($country, $sector){
        $sectors = DB::table('tbsector')
            ->where('tbsector.countryID', '=', $country)
            ->where('tbsector.sectorName', '=', $sector)
            ->get();
        if(count($sectors) == 0){
          return 0;
        }
        else{
          $sectors = DB::table('tbsector')
              ->where('tbsector.countryID', '=', $country)
              ->where('tbsector.sectorName', '=', $sector)
              ->first();
          return $sectors->id;
        }
    }

    public function checkRank($rank){
        $ranks = rank::where('RankName', $rank)
               ->get();
        if(count($ranks) == 0){
            return 0;
        }
        else{
          $ranks = rank::where('RankName', $rank)
              ->get();
              foreach ($ranks as $rank) {
                 $rankID = $rank->rankID;
              }
          return $rankID;
        }
    }

    public function getRankNum($rank){
      $ranks = DB::table('tbrank')
          ->where('tbrank.RankName', '=', 'ахлагч')
          ->get();
      foreach ($ranks as $rank) {
          return $rank->RankNum;
      }
    }

    public function getRankID123(){
        return $this->rankID1;
    }
}
