<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;

class ViewBasedataController extends Controller
{

    public function index()
    {
        $urls =  $urls = Vacancy::all();
        return view('job.viewAllJob', ['urls' => $urls]);
    }

    public function create()
    {
        echo 'create';
    }


    public function show(Request $request)
    {
        $users = Vacancy::where('indexjob', $request->id);
        if ($users == null) {
            return redirect(url('/'));
        }
        if  ($request->param == 'del') {
            $users->delete();
            //  echo 'this column is drop';
            return redirect(url('/'));
        }
        $users = $users->get()->toArray()[0];
        return view('job.viewData', ['users' => $users, 'idJob' => $users["indexjob"]]);
    }


}
