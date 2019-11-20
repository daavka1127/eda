<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\DataTables;
use App\training;
use App\Http\Controllers\employeeController;

class trainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $units = DB::table('tbunit')
            ->orderby('id')
            ->get();
        $trainingCountries = DB::table('tbtrainingcountry')
            ->orderby('countryName')
            ->get();
        return view('training.training', compact('units', 'trainingCountries'));
    }

    public function getTraining(Request $req){
        $trainings = DB::table('tbtraining')
            ->join('tbemployee', 'tbtraining.RD', '=', 'tbemployee.RD')
            ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
            ->join('tbtrainingtype', 'tbtraining.trainingType', '=', 'tbtrainingtype.id')
            ->join('users', 'tbtraining.admin', '=', 'users.id')
            ->select('tbtraining.id', 'tbtraining.RD', 'tbemployee.lastName', 'tbemployee.firstname',
            'tbtrainingtype.trainingTypeName', 'tbtraining.trainingCoutnry',
            'tbtraining.trainingName', 'tbtraining.trainingName', 'tbtraining.leaveDate', 'tbtraining.arriveDate',
            'tbtraining.date', 'users.name', 'tbunit.unit', 'tbemployee.unit as unitID', 'tbemployee.rank', 'tbtrainingtype.id as trainingTypeID')
            ->get();
        return DataTables::of($trainings)
            ->make(true);
    }

    public function store(Request $req){
        try{
            if($req->isInsert == 0){
                //update
                employeeController::updateFromExcel($req->rd, $req->lastname, $req->firstname, $req->huis, $req->unit, $req->rank);
            }
            else if($req->isInsert == 1){
                employeeController::storeFromExcel($req->rd, $req->lastname, $req->firstname, $req->huis, $req->unit, $req->rank);
            }
            $parts = explode('/',$req->leaveDate);
            $date1 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $parts = explode('/',$req->arriveDate);
            $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $training = new training;
            $training->trainingType = $req->trainingType;
            $training->trainingCoutnry = $req->trainingCountry;
            $training->trainingName = $req->tailbar;
            $training->RD = $req->rd;
            $training->leaveDate = $date1;
            $training->arriveDate = $date2;
            $training->date = date("Y/m/d h:i:s");
            $training->admin = Auth::user()->id;
            $training->save();
            return ['success' => true, 'message' => 'Амжилттай хадгаллаа.'];
        } catch(Exception $e){
            return ['success' => false, 'message' => 'Алдаа гарлаа.'];
        }
    }

    public function update(Request $req){
        try{
            employeeController::updateFromExcel($req->rd, $req->lastname, $req->firstname, $req->huis, $req->unit, $req->rank);
            $parts = explode('/',$req->leaveDate);
            $date1 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $parts = explode('/',$req->arriveDate);
            $date2 = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
            $training = training::find($req->id);
            $training->trainingType = $req->trainingType;
            $training->trainingCoutnry = $req->trainingCountry;
            $training->trainingName = $req->tailbar;
            $training->RD = $req->rd;
            $training->leaveDate = $date1;
            $training->arriveDate = $date2;
            $training->date = date("Y/m/d h:i:s");
            $training->admin = Auth::user()->id;
            $training->save();
            return ['success' => true, 'message' => 'Амжилттай хадгаллаа.'];
        } catch(Exception $e){
            return ['success' => false, 'message' => 'Алдаа гарлаа.'];
        }
    }

    public function delete(Request $req){
        try{
            $training = training::find($req->id);
            $training->delete();
            return ['success' => true, 'message' => 'Амжилттай устгалаа.'];
        } catch(Exception $e){
            return ['success' => false, 'message' => 'Алдаа гарлаа.'];
        }
    }

    public function readmoreTrainings(Request $req){
      $trainings = DB::table('tbtraining')
          ->join('tbemployee', 'tbtraining.RD', '=', 'tbemployee.RD')
          ->join('tbunit', 'tbemployee.unit', '=', 'tbunit.id')
          ->join('tbtrainingtype', 'tbtraining.trainingType', '=', 'tbtrainingtype.id')
          ->join('users', 'tbtraining.admin', '=', 'users.id')
          ->select('tbtrainingtype.trainingTypeName', 'tbtraining.trainingCoutnry',
          'tbtraining.trainingName', 'tbtraining.leaveDate', 'tbtraining.arriveDate',
          'tbtraining.date', 'users.name', 'tbunit.unit')
          ->where('tbtraining.RD', '=', $req->rd)
          ->get();
      return DataTables::of($trainings)
          ->make(true);
    }
}
