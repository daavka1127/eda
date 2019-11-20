<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\userMine;

class userMineController extends Controller
{
    public function store(Request $req){
      $user = new userMine;
      $user->name = $req->name;
      $user->email = $req->email;
      $user->password = $req->password;
      $user->memo = $req->memo;
      $user->save();
      return "Амжилттай хадгаллаа.";
    }
}
