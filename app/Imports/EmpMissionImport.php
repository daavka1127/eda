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
                // if(EmpMissionImport::checkUnit($row[4]) == 0){
                //     $tailbar="Ангийн нэр зөрж байна.";
                // }
                // else{
                //   $unitID = EmpMissionImport::checkUnit($row[4]);
                // }

                // if(EmpMissionImport::checkSector($this->country, $row[6]) == 0){
                //     $tailbar = "Салбарын нэр зөрж байна.";
                // }
                // else{
                //   $sectorID = EmpMissionImport::checkSector($this->country, $row[6]);
                // }

                if(EmpMissionImport::checkRank($row[7]) == 0){
                    $tailbar = "Цолны нэр зөрж байна.";
                }
                else{
                    $rankID = EmpMissionImport::checkRank($row[7]);
                    $rankType = EmpMissionImport::getRankNum($row[7]);
                }
                if($tailbar == ""){
                  // $rd = $row[0];
                  $rd = $row[0];
                  if($row[0] == ''){
                      // $emp1 = new employee;
                      $rd = $this->employee->getEmptyRD();
                  }
                    $emps = DB::table("tbemployee")
                        ->where('tbemployee.RD', '=', $rd)
                        ->get();
                    $empsCheck = DB::table('tbemployee')
                        ->where('lastName', '=', $row[1])
                        ->where('firstname', '=', $row[2])
                        ->where('sex', '=', $row[3])
                        ->where('unit', '=', $row[4])
                        ->where('rank', '=', $row[5])
                        ->get();
                    if(count($empsCheck) > 0 && $row[0] == ''){

                    }
                    else if($row[0] != ''){
                      if(count($emps) == 0){
                          employeeController::storeFromExcel($rd, $row[1], $row[2], $row[3], $row[4], $row[5]);
                      }
                      else{
                          employeeController::updateFromExcel($rd, $row[1], $row[2], $row[3], $row[4], $row[5]);
                      }
                      $missions = DB::table("tbmission")
                          ->where('tbmission.RD', '=', $rd)
                          ->where('tbmission.country', $this->country)
                          ->where('tbmission.eelj', $this->eelj)
                          ->get();
                      if(count($missions) == 0){
                          missionController::storeFromExcel($rd, $this->country, $this->eelj, $sectorID, $rankType, $rankID, $row[8]);
                      }
                    }
                    else{
                      if(count($emps) == 0){
                          employeeController::storeFromExcel($rd, $row[1], $row[2], $row[3], $row[4], $row[5]);
                      }
                      else{
                          employeeController::updateFromExcel($rd, $row[1], $row[2], $row[3], $row[4], $row[5]);
                      }
                      $missions = DB::table("tbmission")
                          ->where('tbmission.RD', '=', $rd)
                          ->where('tbmission.country', $this->country)
                          ->where('tbmission.eelj', $this->eelj)
                          ->get();
                      if(count($missions) == 0){
                          missionController::storeFromExcel($rd, $this->country, $this->eelj, $sectorID, $rankType, $rankID, $row[8]);
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
                  $excel->salbar = $row[6];
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
              ->first();
          return $ranks->rankID;
        }
    }

    public function getRankNum($rank){
      $ranks = DB::table('tbrank')
          ->where('tbrank.RankName', '=', 'ахлагч')
          ->first();
      return $ranks->RankNum;
    }

    public function getRankID123(){
        return $this->rankID1;
    }
}
