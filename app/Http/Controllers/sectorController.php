<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\sector;
use Response;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class sectorController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function show(){
        $countries = DB::table('tbcountry')
            ->get();
        return view('sector.sector', compact('countries'));
    }

    public function store(Request $req){
        $sector = new sector;
        $sector->countryID = $req->countryID;
        $sector->sectorName = $req->sectorName;
        $sector->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $req){
        $sector = sector::find($req->id);
        $sector->sectorName = $req->sectorName;
        $sector->save();
        return "Амжилттай заслаа.";
    }

    public function delete(Request $req){
        $sector = sector::find($req->id);
        $sector->delete();
    }

    public function getSector(Request $req){
      $sectors = DB::table('tbsector')
          ->join('tbcountry', 'tbsector.countryID', '=', 'tbcountry.id')
          ->select('tbsector.*', 'tbcountry.id as id1', 'tbcountry.countryName')
          ->where('tbsector.countryID', '=', $req->id)
          ->get();
          //return $sectors;
      return DataTables::of($sectors)
          ->addColumn('action', '<input type="button" class="btn btn-warning" onclick=editSector({{$id}}) value="Засах" id="editSector{{$id}}" /> <input type="button" class="btn btn-danger" value="Устгах" onclick="deleteSector({{$id}})" id="deleteSector" />')
          ->rawColumns(['action'])
          ->make(true);
    }

    public function getSectorCombo(Request $req){
      $sectors = DB::table('tbsector')
          ->where('tbsector.countryID', '=', $req->countryID)
          ->pluck('id', 'sectorName');
          //return $sectors;
      return $sectors;
    }
}
