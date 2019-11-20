<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\unit;
use Response;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class unitController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(){
        $units = DB::table('tbunit')
            ->orderby('id', 'ASC')
            ->get();
        return view('unit.unit', compact('units'));
    }

    public function store(Request $req){
        $unit = new unit;
        $unit->id = $req->id;
        $unit->unitParent = $req->unitParent;
        $unit->unit = $req->unit;
        $unit->memo = $req->memo;
        $unit->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $req){
        $unit = unit::find($req->old_id);
        $unit->id = $req->id;
        $unit->unitParent = $req->unitParent;
        $unit->unit = $req->unit;
        $unit->memo = $req->memo;
        $unit->save();
        return "Амжилттай заслаа.";
    }

    public function delete(Request $req){
        $unit = unit::find($req->id);
        $unit->delete();
    }

    public function checkUnitID(Request $req){
        $unitsCount = DB::table("tbunit")
            ->where('id', '=', $req->id)
            ->count();
        return $unitsCount;
    }

    public function show1(Request $request){
      $limit = intVal($request->input('length'));
      $start = $request->input('start');
      $offset = intVal($start);
      $units = DB::table('tbunit')
          ->offset($offset)
          ->limit($limit)
          ->get();
      $totalRecords = DB::table('tbunit')
          ->count();
      return DataTables::of($units)
          ->addColumn('action', '<input type="button" class="btn btn-warning" value="Засах" id="editUnit" /> <input type="button" class="btn btn-danger" value="Устгах" id="deleteUnit" />')
          ->rawColumns(['action'])
          ->make(true);
      //return unit::query();
    }
}
