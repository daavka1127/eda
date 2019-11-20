<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\rank;
use App\rankType;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class rankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getRank(Request $req){
        $ranks = DB::table('tbrank')
            ->where('RankNum', '=', $req->rankNum)
            ->pluck('tbrank.rankID', 'tbrank.RankName');
        return $ranks;
    }
}
