<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;

class BaseDataController extends Controller
{

    public function index(Vacancy $getLinksJob)
    {
        $urls=$getLinksJob->getLinksJob();
        return view('job.viewAllJob', ['urls'=>$urls]);
    }


    public function create()
    {
       echo 'create';
    }


    public function store(Request $request)
    {
        echo 'store';
    }

     public function show(Vacancy $getJobVacancy, Request $request)
    {
        $users=$getJobVacancy->getJobVacancy($request->id, $request->param);
       if ($users==null) {return redirect(url('/db'));}

       return view('job.viewData', ['users'=>$users, 'idJob'=>$users["indexJobAion"]]);
    }

    public function edit($id)
    {  echo 'edit';  }

    public function update(Vacancy $updateJobinBase)
    {
        $data  = session()->get('flesh')['data'];
        $index  = session()->get('flesh')['index'];
        $updateJobinBase->updateJobinBase($data, $index);
        return view('job.afterSaveBasedata', compact('data','index'));
    }

    public function destroy($id)
    {        echo 'destroy';     }
}
