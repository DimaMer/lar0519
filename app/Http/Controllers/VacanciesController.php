<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Vacancy;

class VacanciesController extends Controller
{

    public function index()
    {
        $vacancy = Vacancy::all();
        $company = Company::all();
        return view('view_database.viewAllJob', ['vacancy' => $vacancy, 'company' => $company]);
    }

    public function create()
    {
                echo 'create';
    }


    public function show($id)
    {
        $users = Vacancy::where('indexjob', $id);
        if (!$users||!$users->get()->toArray()) {
            return redirect(url('/'));
        }
        $users = $users->get()->toArray()[0];
        return view('view_database.viewData', ['users' => $users, 'idJob' => $users["indexjob"]]);
    }

    public function destroy($id)
    {
        $users = Vacancy::where('indexjob', $id);
        $users->delete();
        return redirect(url('/'));
    }


}
