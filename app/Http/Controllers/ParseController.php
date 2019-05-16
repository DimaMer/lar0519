<?php

namespace App\Http\Controllers;

use App\Models\Parser;
use Illuminate\Http\Request;
use DB;

class ParseController extends Controller
{

//------------------------------------------------------------


    public function index()
    {
        return view('job.selectParse');
    }


    public function store(Parser $getResultParse, Request $request)
    {
$result = $getResultParse->getResultParse($request);
        return view('job.afterParse', ['data'=>$result['data'],'index'=>$result['idJob'] ]);

    }







    public function create()
    {
        echo'create';
    }


    public function show($id)
    {
        echo 'show';//
    }

       public function edit($id)
    {
        echo 'edit';//
    }

       public function update(Request $request, $id)
    {
        echo 'update';//
    }

       public function destroy($id)
    {
        echo 'destroy';//
    }


}
