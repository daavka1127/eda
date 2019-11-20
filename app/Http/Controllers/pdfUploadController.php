<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use App\pdfUpload;
use Response;
use File;
use Illuminate\Support\Facades\Auth;

class pdfUploadController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function showPdfUpload(){
        return view('pdfUpload.pdfUpload');
    }

    public function savePdf(Request $req){
        // $this->validate($req, [
        //     'filePdf' => 'required|mimes:application/pdf, application/x-pdf,application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf|max:10000'
        // ]);

        //if($req->hasFile('filePdf')){
            $image_path = public_path('/pdf/showPdf.pdf');
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $pdfFile = $req->file('filePdf');
            $new_name = "showPdf." . $pdfFile->getClientOriginalExtension();
            $pdfFile->move(public_path("/pdf"), $new_name);
        //}

        return back()->with('success', 'Амжилттай хадгаллаа.');

        //return redirect('/upload/pdf')->with('success', "uploaded davaa");
    }
}
