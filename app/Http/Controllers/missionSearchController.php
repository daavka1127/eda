<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\employee;

class missionSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMissionSearch(){
        $countries = DB::table('tbcountry')
            ->get();
        return view('missionSearch.missionSearch', compact('countries'));
    }

    public function showMissionSearchTest(){
      $countries = DB::table('tbcountry')
          ->get();
      $rankTypes = DB::table('tbranktype')
          ->get();
      $units = DB::table('tbunit')
          ->orderby('id', 'ASC')
          ->get();
      return view('missionSearch.missionSearchTest', compact('countries', 'rankTypes', 'units'));
    }

    public function searchMission(Request $req){
        $missions = DB::table('tbmission')
            ->join('tbemployee', 'tbmission.RD', '=', 'tbemployee.RD')
            ->select('tbmission.RD', 'tbemployee.lastName', 'tbemployee.firstname',
            DB::raw('(select COUNT(*) FROM tbmission as t1 WHERE t1.RD = tbmission.RD) as countOp'));
            if($req->opName != -1){
              $missions->where('tbmission.country', '=', $req->opName);
            }
            if($req->eelj != -1){
              $missions->where('tbmission.eelj', '=', $req->eelj);
            }
            if($req->sector != -1){
              $missions->where('tbmission.sector', '=', $req->sector);
            }
            $missions->where('tbmission.RD', 'like', $req->rd . '%');
            $missions->where('tbemployee.lastName', 'like', $req->lastName . '%');
            $missions->where('tbemployee.firstname', 'like', $req->firstname . '%');
            $missions->groupby('tbmission.RD', 'tbemployee.lastName', 'tbemployee.firstname');
            $missions->get();

        return DataTables::of($missions->get())
            ->addColumn('readMore', '<input type="button" onclick=readmoreMisstionByEmp("{{$RD}}") value="Дэлгэрэнгүй" />')
            ->rawColumns(['readMore'])
            ->make(true);
    }

    public function searchMissionFast(Request $request){
        // try{
            $orderby = $request->input('order.0.column');
            $sort['col'] = $request->input('columns.' . $orderby . '.data');
            $sort['dir'] = $request->input('order.0.dir');
            $missions = employee::join('tbmission', 'tbmission.RD', '=', 'tbemployee.RD')
                ->select('tbemployee.RD as RD1', 'tbemployee.lastName', 'tbemployee.firstname',
                    'tbemployee.unit', 'tbemployee.rank', 'tbemployee.sex',
            DB::raw('(select COUNT(*) FROM tbmission as t1 WHERE t1.RD = tbmission.RD) as countOp'))
                // $missions->addSelect(DB::raw("'asd' as fakeColumn"));
                ->where('tbemployee.RD', 'like', $request->rd . '%')
                ->where('tbemployee.lastName', 'like', $request->lastName . '%')
                ->where('tbemployee.firstname', 'like', $request->firstname . '%');
            if($request->opName != -1){
              $missions->where('tbmission.country', '=', $request->opName);
            }
            if($request->eelj != -1){
              $missions->where('tbmission.eelj', '=', $request->eelj);
            }
            if($request->sector != -1){
              $missions->where('tbmission.sector', '=', $request->sector);
            }


            $output['recordsTotal'] = $missions->count();

            $output['data'] = $missions
                    ->orderBy($sort['col'], $sort['dir'])
                    ->groupby('tbemployee.RD', 'tbmission.RD', 'tbemployee.lastName', 'tbemployee.firstname', 'tbemployee.unit',
                        'tbemployee.rank', 'tbemployee.sex')
                    ->skip($request->input('start'))
                    ->take($request->input('length',10))
                    // $missions
                    ->get();

            $output['recordsFiltered'] = $output['recordsTotal'];

            $output['draw'] = intval($request->input('draw'));

            return $output;
        // }catch(\Exception $e){
        //     return "Серверийн алдаа!!! Веб мастерт хандана уу";
        // }
    }
}
