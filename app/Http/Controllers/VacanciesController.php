<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Vacancy;
use GuzzleHttp\Client;

class VacanciesController extends Controller
{
    public function index()
    {
        $vacancy = Vacancy::all();
        return view('view_database.viewAllJob', ['vacancy' => $vacancy]);
    }

    public function show($id)
    {
        $users = Vacancy::Join('companies', 'url_parent_site', '=', 'company_id')
            ->where('indexjob', $id);

        if (!$users || !$users->get()->toArray()) {
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

    public function store(Request $request)
    {
        $jsson = array();
        $vac = collect();

        if (@$_POST['all']) {
            $vac = Vacancy::Join('companies', 'url_parent_site', '=', 'company_id')
                ->get()->toArray();
        } else {
            foreach ($_POST as $key => $vacan) {
               $vac->push(Vacancy::Join('companies', 'url_parent_site', '=', 'company_id')
                    ->where('indexjob', $vacan)->first());
            }
        }

        foreach ($vac as $key => $vacan) {
            $jsson[$key]["id"]          =   $vac[$key]['id'];
            $jsson[$key]["vacancy_id"]  =   $vac[$key]['indexjob'];
            $jsson[$key]["name"]        =   $vac[$key]['vacancy'];
            $jsson[$key]["companyName"] =   $vac[$key]['company'];
            $jsson[$key]["city"]        =   $vac[$key]['cityVacancyCity'];
            $jsson[$key]["date"]        =   $vac[$key]['time'];
            $jsson[$key]["salary"]      =   '0';
            $jsson[$key]["salary_unit"] =   '$';
            $jsson[$key]["description"] =   $vac[$key]['vacancyInfoWrapper'];
           $jsson[$key]["site"]         =   $vac[$key]['url_company'];
            $jsson[$key]["logo"]        =   $vac[$key]['logo_company'];
        }
        $jsson = json_encode($jsson);




//       $client = new Client([
//        'headers' => [ 'Content-Type' => 'application/json' ]
//        ]);
//        $url='';
//        $response = $client->post($url,
//            ['body' => $jsson
//            ]
//        );

        return view('view_database.viewJsonSebd', ['vacancy' => $jsson]);

    }


}
