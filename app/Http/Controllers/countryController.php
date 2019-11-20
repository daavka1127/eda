<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\country;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request){
        $country = new country;
        $country->countryName = $request->input('txtCountryNew');
        $country->save();
        return "Амжилттай хадгаллаа.";
    }

    public function update(Request $request){
        $country = country::find($request->countryID);
        $country->countryName = $request->txtCountryEdit;
        $country->save();
        return "Амжилттай заслаа.";
    }

    public function delete(Request $request){
        $country = country::find($request->countryID);
        $country->delete();
    }

    public function getCountries(){
        $countries = DB::table('tbcountry')
            ->pluck('id', 'countryName');
        return $countries;
    }
}
