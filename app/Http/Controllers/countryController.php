<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\country;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class countryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $countries = DB::table('tbcountry')->get();
        $operations = DB::table('tbajillagaa')
            ->join('tbcountry', 'tbajillagaa.country', '=', 'tbcountry.id')
            ->select('tbajillagaa.*', 'tbcountry.countryName')
            ->get();
        return view('ajillagaa.ajillagaa', compact('countries', 'operations'));
    }

    public function show(){
        $countries = DB::table('tbcountry')->get();
        return view('country.countryShow', compact('countries'));
    }

    public function showEelj(){
        $countries = DB::table('tbcountry')->get();
        return view('eelj.eeljShow', compact('countries'));
    }

    public function store(Request $request){
        try{
            $country = new country;
            $country->countryName = $request->input('txtCountryNew');
            $country->save();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай хадгаллаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }

    }

    public function update(Request $request){
        try{
            $country = country::find($request->countryID);
            $country->countryName = $request->txtCountryEdit;
            $country->save();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай заслаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }

    public function delete(Request $request){
        try{
            $country = country::find($request->countryID);
            $country->delete();
            $array = array(
                'status' => 'success',
                'msg' => 'Амжилттай устгалаа!!!'
            );
            return $array;
        }catch(\Exception $e){
            $array = array(
                'status' => 'error',
                'msg' => 'Серверийн алдаа!!! Веб мастерт хандана уу!!!'
            );
            return $array;
        }
    }

    public function getCountries(){
        $countries = DB::table('tbcountry')
            ->pluck('id', 'countryName');
        return $countries;
    }

    public function getCountriesDatatable(Request $req){
        $countries = DB::table('tbcountry')
            ->get();
        return DataTables::of($countries)
            // ->addColumn('edit', '<input type="button" class="btn btn-warning" value="Засах" onclick="editCountry("{{$RD}}", "{{countryName}}")" />')
            // ->addColumn('delete', '<input type="button" class="btn btn-danger" value="Устгах" onclick="deleteCountry({{$id}})" />')
            // ->rawColumns(['edit', 'delete'])
            ->make(true);
    }

    public function getEeljDatatable(Request $req){
            $countries = DB::table('tbajillagaa')
                ->join('tbcountry', 'tbajillagaa.country', '=', 'tbcountry.id')
                ->select('tbajillagaa.*', 'tbcountry.countryName', 'tbcountry.id as countryID')
                ->where('tbajillagaa.country', '=', $req->countryID)
                ->get();
        return DataTables::of($countries)
            // ->addColumn('edit', '<input type="button" class="btn btn-warning" value="Засах" onclick="editCountry("{{$RD}}", "{{countryName}}")" />')
            // ->addColumn('delete', '<input type="button" class="btn btn-danger" value="Устгах" onclick="deleteCountry({{$id}})" />')
            // ->rawColumns(['edit', 'delete'])
            ->make(true);
    }
}
