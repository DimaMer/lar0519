<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BaseDataController extends Controller
{

    public function index(Request $request)
    {
        $lin=DB::table('vacancy_parser')->select('indexJobAion','httpAinua')->get();
        return view('job.viewAllJob', ['lin'=>$lin]);
    }


    public function create()
    {
       echo 'create';
    }


    public function store(Request $request)
    {
        echo 'store';
    }

     public function show(Request $request)
    {
        //dump( $request->param);
        //dump( $request->id);
        $users=DB::table('vacancy_parser')->where('indexJobAion',$request->id)->first();
        if ($users==null) {
            echo 'not found';
            return redirect(url('/db')); //view('job.afterSaveBasedata');
        }

        if ($request->param=='del') {

            DB::table('vacancy_parser')->where('indexJobAion',$request->id)->delete();
            echo'this column is drop';
            return view('job.viewData', ['users'=>$users]);

        }
//dump($users);
       return view('job.viewData', ['users'=>$users]);
    }

    public function edit($id)
    {  echo 'edit';  }

    public function update(Request $request, $id)
    {
        $data  = session()->get('flesh')['data'];
        $index  = session()->get('flesh')['index'];
        $i=0;
        foreach ($data as $key=>$value) {
            if (DB::table('vacancy_parser')->where('indexJobAion', $index[$i])->first()==NULL)
            {

                DB::table('vacancy_parser')->insertGetId(
                    ['indexJobAion' => $index[$i], 'httpAinua' => $key]
                );}
            foreach ($value as $key1=>$value1) {

                DB::table('vacancy_parser')
                    ->where('indexJobAion', $index[$i])
                    ->update([$key1 => $value1]);
            }$i++;}
        return view('job.afterSaveBasedata', compact('data','index')); //
    }

    public function destroy($id)
    {        echo 'destroy';     }
}
