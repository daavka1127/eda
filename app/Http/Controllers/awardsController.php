<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\awards;
use Response;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class awardsController extends Controller
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
              ->get();
          return view('awards.awards', compact('countries', 'rankTypes', 'units'));
      }

    public function getAwards(Request $req){
        $awards = DB::table('tbmissionawards')
            ->join('tbemployee', 'tbmissionawards.RD', '=', 'tbemployee.RD')
            ->join('tbcountry', 'tbmissionawards.country', '=', 'tbcountry.id')
            ->join('tbmission', function($join)
            {
                $join->on('tbmissionawards.RD', '=', 'tbmission.RD')
                ->on('tbmissionawards.country', '=', 'tbmission.country')
                ->on('tbmissionawards.eelj', '=', 'tbmission.eelj');
            })
            // ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            // ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
            // ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
            ->join('users', 'tbmissionawards.admin', '=', 'users.id')
            ->select('tbmissionawards.id', 'tbcountry.countryName', 'tbmissionawards.eelj', 'tbmissionawards.RD', 'tbemployee.lastName',
                     'tbemployee.firstname', 'tbmission.rank as rankName', 'tbmission.operationRank',
                     'tbmissionawards.tailbar', 'tbmissionawards.date', 'users.name')
            ->orderby('tbcountry.countryName', 'ASC')
            ->orderby('tbmissionawards.eelj', 'ASC')
            ->get();
          return DataTables::of($awards)
              ->make(true);
    }

    public function store(Request $req){
        $awards = new awards;
        $awards->rd = $req->rd;
        $awards->country = $req->country;
        $awards->eelj = $req->eelj;
        $awards->tailbar = $req->tailbar;
        $parts = explode('/',$req->date);
        $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $awards->date = $date2;
        $awards->admin = Auth::user()->id;
        $awards->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $req){
      $awards = awards::find($req->id);
      $awards->tailbar = $req->tailbar;
      $parts = explode('/',$req->date);
      $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
      $awards->date = $date2;
      $awards->admin = Auth::user()->id;
      $awards->save();
      return "Амжилттай заслаа";
    }

    public function delete(Request $req){
        $awards = awards::find($req->id);
        $awards->delete();
        return "Амжилттай устгалаа.";
    }

    public function readmoreAwads(Request $req){
        $awards = DB::table('tbmissionawards')
            ->join('tbcountry', 'tbmissionawards.country', '=', 'tbcountry.id')
            ->join('users', 'tbmissionawards.admin', '=', 'users.id')
            ->select('tbmissionawards.id', 'tbmissionawards.country', 'tbcountry.countryName', 'tbmissionawards.eelj', 'tbmissionawards.tailbar', 'tbmissionawards.date', 'users.name')
            ->where('tbmissionawards.RD', '=', $req->rd)
            ->get();
        return DataTables::of($awards)
            ->make(true);
    }

    public function changeRD($newRd, $oldRd){
        $awards = awards::where('RD', $oldRd)->update(['RD'=>$newRd]);
    }
}
