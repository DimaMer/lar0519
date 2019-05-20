<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;

class BaseDataController extends Controller
{

    public function index(Vacancy $getLinksJob)
    {
        $urls = Vacancy::select('indexJobAion', 'httpAinua')->get();
        return view('job.viewAllJob', ['urls' => $urls]);
    }

    public function create()
    {
        echo 'create';
    }


    public function show(BaseDataController $getJobVacancy, Request $request)
    {
        $users = Vacancy::where('indexJobAion', $request->id);
        if ($users == null) {
            return redirect(url('/'));
        }
        $users = $users->get()->toArray()[0];
        if ($request->param == 'del') {
            Vacancy::where('indexJobAion', $request->id)->delete();
            echo 'this column is drop';
            return redirect(url('/'));
        }
        return view('job.viewData', ['users' => $users, 'idJob' => $users["indexJobAion"]]);
    }


}
