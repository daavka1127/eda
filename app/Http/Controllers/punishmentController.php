<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mission;
use App\punishment;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;

class punishmentController extends Controller
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
        return view('punishment.punishmentShow', compact('countries', 'rankTypes', 'units'));
    }

    public function getPunishmentsByEelj(Request $req){
        $punishments = DB::table('tbmissionpunishment')
            ->join('tbemployee', 'tbmissionpunishment.RD', '=', 'tbemployee.RD')
            ->join('tbcountry', 'tbmissionpunishment.country', '=', 'tbcountry.id')
            ->join('tbmission', function($join)
            {
                $join->on('tbmissionpunishment.RD', '=', 'tbmission.RD')
                ->on('tbmissionpunishment.country', '=', 'tbmission.country')
                ->on('tbmissionpunishment.eelj', '=', 'tbmission.eelj');
            })
            ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
            ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
            ->join('users', 'tbmissionpunishment.admin', '=', 'users.id')
            ->select('tbmissionpunishment.id', 'tbcountry.countryName', 'tbmissionpunishment.eelj', 'tbsector.sectorName', 'tbmissionpunishment.RD', 'tbemployee.lastName',
                     'tbemployee.firstname', 'tbranktype.TypeName as rankTypeName', 'tbrank.RankName as rankName', 'tbmission.operationRank',
                     'tbmissionpunishment.tailbar', 'tbmissionpunishment.date', 'users.name')
            ->get();
          return DataTables::of($punishments)
              ->make(true);
    }

    public function getPunishments(Request $req){
        $punishments = DB::table('tbmissionpunishment')
            ->join('tbemployee', 'tbmissionpunishment.RD', '=', 'tbemployee.RD')
            ->join('tbcountry', 'tbmissionpunishment.country', '=', 'tbcountry.id')
            ->join('tbmission', function($join)
            {
                $join->on('tbmissionpunishment.RD', '=', 'tbmission.RD')
                ->on('tbmissionpunishment.country', '=', 'tbmission.country')
                ->on('tbmissionpunishment.eelj', '=', 'tbmission.eelj');
            })
            ->join('tbsector', 'tbmission.sector', '=', 'tbsector.id')
            ->join('tbranktype', 'tbmission.rankType', '=', 'tbranktype.rankTypeID')
            ->join('tbrank', 'tbmission.rank', '=', 'tbrank.rankID')
            ->join('users', 'tbmissionpunishment.admin', '=', 'users.id')
            ->select('tbmissionpunishment.id', 'tbcountry.countryName', 'tbmissionpunishment.eelj', 'tbsector.sectorName', 'tbmissionpunishment.RD', 'tbemployee.lastName',
                     'tbemployee.firstname', 'tbranktype.TypeName as rankTypeName', 'tbrank.RankName as rankName', 'tbmission.operationRank',
                     'tbmissionpunishment.tailbar', 'tbmissionpunishment.date', 'users.name');

    }

    public function store(Request $req){
        $punishment = new punishment;
        $punishment->rd = $req->rd;
        $punishment->country = $req->country;
        $punishment->eelj = $req->eelj;
        $punishment->tailbar = $req->tailbar;
        $parts = explode('/',$req->date);
        $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
        $punishment->date = $date2;
        $punishment->admin = Auth::user()->id;
        $punishment->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $req){
      $punishment = punishment::find($req->id);
      $punishment->tailbar = $req->tailbar;
      $parts = explode('/',$req->date);
      $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
      $punishment->date = $date2;
      $punishment->admin = Auth::user()->id;
      $punishment->save();
      return "Амжилттай заслаа";
    }

    public function delete(Request $req){
        $punishment = punishment::find($req->id);
        $punishment->delete();
        return "Амжилттай устгалаа.";
    }

    public function readmorePunishments(Request $req){
        $punishments = DB::table('tbmissionpunishment')
            ->join('tbcountry', 'tbmissionpunishment.country', '=', 'tbcountry.id')
            ->join('users', 'tbmissionpunishment.admin', '=', 'users.id')
            ->select('tbcountry.countryName', 'tbmissionpunishment.eelj', 'tbmissionpunishment.tailbar', 'tbmissionpunishment.date',
            'users.name')
            ->where('tbmissionpunishment.RD', '=', $req->rd)
            ->get();
        return DataTables::of($punishments)
            ->make(true);
    }
}
