<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mission;
use App\employee;
use App\SSP;
use Response;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class testingController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    public function test(){
        $permission = Auth::user()->id;
        $date = date("Y/m/d h:i:s");
        return $date;
    }

    public function test1(Request $req){
      $emps = DB::table('tbmission')
          ->join('tbemployee', 'tbmission.RD', '=', 'tbemployee.RD')
          ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
          ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
          ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
          ->join('users', 'tbmission.admin', '=', 'users.id')
          ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
          ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
          ->select('tbmission.*', 'tbemployee.lastName', 'tbemployee.firstname', 'tbemployee.rank', 'tbunit.unit', 'users.name', 'tbranktype.TypeName', 'tbrank.RankName', 'tbcountry.countryName', 'tbsector.sectorName', DB::raw('(select COUNT(tbmission.RD) FROM tbmission) as countOp'))
          ->where('tbmission.country', '=', $req->country)
          ->where('tbmission.eelj', '=', $req->eelj)
          ->get();
      return $emps;
    }

    public function testingMissions(Request $req){
        $emps = DB::table('tbmission')
            ->join('tbemployee', 'tbmission.RD', '=', 'tbemployee.RD')
            ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
            ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
            ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
            ->join('users', 'tbmission.admin', '=', 'users.id')
            ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
            ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->select('tbmission.*', 'tbmission.rank as rankCode', 'tbemployee.lastName', 'tbemployee.firstname', 'tbemployee.rank', 'tbemployee.unit as unitID',
            'tbunit.unit', 'users.name', 'tbranktype.TypeName', 'tbrank.RankName', 'tbcountry.countryName', 'tbsector.sectorName',
            DB::raw('(select COUNT(*) FROM tbmission as t1 WHERE t1.RD = tbmission.RD) as countOp'));

            //$totalData = $

          $columns = array(
              0 => 'country',
              1 => 'eelj',
              2 => 'sector',
              3 => 'rankType',
              4 => 'rankCode',
              5 => 'readMore',
              6 => 'id',
              7 => 'countryName',
              8 => 'sectorName',
              9 => 'RD',
              10 => 'lastName',
              11 => 'firstname',
              12 => 'unit',
              13 => 'TypeName',
              14 => 'RankName',
              15 => 'operationRank',
              16 => 'countOp',
              17 => 'date',
              18 => 'name',
          );



      return DataTables::of($emps)
          ->addColumn('readMore', '<input type="button" onclick=readmoreMisstionByEmp("{{$RD}}") value="Дэлгэрэнгүй" />')
          ->rawColumns(['readMore'])
          ->make(true);
    }

    // public function testing1Sda(Request $request){
    //     $columns = array(
    //         0 => 'country',
    //         1 => 'eelj',
    //         2 => 'sector',
    //         3 => 'rankType',
    //         4 => 'rankCode',
    //         5 => 'readMore',
    //         6 => 'id',
    //         7 => 'countryName',
    //         8 => 'sectorName',
    //         9 => 'RD',
    //         10 => 'lastName',
    //         11 => 'firstname',
    //         12 => 'unit',
    //         13 => 'TypeName',
    //         14 => 'RankName',
    //         15 => 'operationRank',
    //         16 => 'countOp',
    //         17 => 'date',
    //         18 => 'name',
    //     );
    //     $totalData = DB::table('tbmission')
    //       ->join('tbemployee', 'tbmission.RD', '=', 'tbemployee.RD')
    //       ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
    //       ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
    //       ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
    //       ->join('users', 'tbmission.admin', '=', 'users.id')
    //       ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
    //       ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
    //       ->select('tbmission.*', 'tbmission.rank as rankCode', 'tbemployee.lastName', 'tbemployee.firstname', 'tbemployee.rank', 'tbemployee.unit as unitID',
    //       'tbunit.unit', 'users.name', 'tbranktype.TypeName', 'tbrank.RankName', 'tbcountry.countryName', 'tbsector.sectorName',
    //       DB::raw('(select COUNT(*) FROM tbmission as t1 WHERE t1.RD = tbmission.RD) as countOp'))
    //       ->count();
    //
    //     if(empty($request->('search.value'))){
    //         $totalFiltered = $totalData;
    //     }
    //     else{
    //         $search = $request->input('search.value');
    //
    //         $totalFiltered = DB::table('tbmission')
    //           ->join('tbemployee', 'tbmission.RD', '=', 'tbemployee.RD')
    //           ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
    //           ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
    //           ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
    //           ->join('users', 'tbmission.admin', '=', 'users.id')
    //           ->join('tbcountry', 'tbmission.country', '=', 'tbcountry.id')
    //           ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
    //           ->select('tbmission.*', 'tbmission.rank as rankCode', 'tbemployee.lastName', 'tbemployee.firstname', 'tbemployee.rank', 'tbemployee.unit as unitID',
    //           'tbunit.unit', 'users.name', 'tbranktype.TypeName', 'tbrank.RankName', 'tbcountry.countryName', 'tbsector.sectorName',
    //           DB::raw('(select COUNT(*) FROM tbmission as t1 WHERE t1.RD = tbmission.RD) as countOp'))
    //           ->where('countryName', 'LIKE', "%{$search}%")
    //           ->orWhere('sectorName', 'LIKE', "%{$search}%")
    //           ->orWhere('RD', 'LIKE', "%{$search}%")
    //           ->orWhere('lastName', 'LIKE', "%{$search}%")
    //           ->orWhere('firstname', 'LIKE', "%{$search}%")
    //           ->orWhere('unit', 'LIKE', "%{$search}%")
    //           ->orWhere('TypeName', 'LIKE', "%{$search}%")
    //           ->orWhere('RankName', 'LIKE', "%{$search}%")
    //           ->orWhere('operationRank', 'LIKE', "%{$search}%")
    //           ->orWhere('countOp', 'LIKE', "%{$search}%")
    //           ->orWhere('date', 'LIKE', "%{$search}%")
    //           ->orWhere('name', 'LIKE', "%{$search}%")
    //           ->count();
    //     }
    //
    //     return $totalData;
    // }

    public function sdaSSP(Request $request){
        $table = 'tbmission';

        $primaryKey = 'id';

        $columns = array(
          array( 'db' => '`tbmission`.`country`',   'dt' => 0, 'field' => 'country' ),
          array( 'db' => '`tbmission`.`sector`',     'dt' => 1, 'field' => 'sector'),
          array( 'db' => '`tbmission`.`rankType`',  'dt' => 2, 'field' => 'rankType' ),
          array( 'db' => '`tbmission`.`rank` as rankCode',  'dt' => 3, 'field' => 'rankCode' ),
          array( 'db' => '`tbmission`.`id`', 'dt' => 4, 'field' => 'id' ),
          array( 'db' => '`tbcountry`.`countryName`',  'dt' => 5, 'field' => 'countryName' ),
          array( 'db' => '`tbmission`.`eelj`', 'dt' => 6, 'field' => 'eelj'),
          array( 'db' => '`tbsector`.`sectorName`',  'dt' => 7, 'field' => 'sectorName' ),
          array( 'db' => '`tbmission`.`RD`',     'dt' => 8, 'field' => 'RD' ),
          array( 'db' => '`tbemployee`.`lastName`',  'dt' => 9, 'field' => 'lastName' ),
          array( 'db' => '`tbemployee`.`firstname`',  'dt' => 10, 'field' => 'firstname' ),
          array( 'db' => '`tbunit`.`unit`',  'dt' => 11, 'field' => 'unit' ),
          array( 'db' => '`tbranktype`.`TypeName`',  'dt' => 12, 'field' => 'TypeName' ),
          array( 'db' => '`tbrank`.`RankName`',  'dt' => 13, 'field' => 'RankName' ),
          array( 'db' => '`tbmission`.`operationRank`',  'dt' => 14, 'field' => 'operationRank' ),
          array( 'db' => '(select COUNT(*) FROM tbmission as t1 WHERE t1.RD = tbmission.RD) as countOp',  'dt' => 15, 'field' => 'countOp' ),
          array( 'db' => '`tbmission`.`date`',  'dt' => 16, 'field' => 'date' ),
          array( 'db' => '`users`.`name`',  'dt' => 17, 'field' => 'name' ),
        );

        $sql_details = array(
            'user' => 'root',
            'pass' => '',
            'db'   => 'db_eda',
            'host' => 'localhost'
        );

        $joinQuery = "FROM `tbmission` ";
        $joinQuery = $joinQuery . "INNER JOIN `tbemployee` ON `tbmission`.`RD` = `tbemployee`.`RD` ";
        $joinQuery = $joinQuery . "INNER JOIN `tbunit` ON `tbemployee`.`unit` = `tbunit`.`id` ";
        $joinQuery = $joinQuery . "INNER JOIN `tbranktype` ON `tbmission`.`rankType` = `tbranktype`.`rankTypeID` ";
        $joinQuery = $joinQuery . "INNER JOIN `tbrank` ON `tbmission`.`rank` = `tbrank`.`rankID` ";
        $joinQuery = $joinQuery . "INNER JOIN `users` ON `tbmission`.`admin` = `users`.`id` ";
        $joinQuery = $joinQuery . "INNER JOIN `tbcountry` ON `tbmission`.`country` = `tbcountry`.`id` ";
        $joinQuery = $joinQuery . "INNER JOIN `tbsector` ON `tbmission`.`sector` = `tbsector`.`id`";

        return json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery )
        );
    }

    public function showingSDA_ssp_CLASS(){
        return view('testingSDA');
    }
}
