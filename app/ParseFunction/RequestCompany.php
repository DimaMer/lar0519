<?php

namespace app\ParseFunction;
use App\Models\Vacancy;
use App\Models\Company;
class RequestCompany
{

    //const PATH_CLASSES= '//*[@class="%s"]';
   function getCompaniesLink()
    {
        $nameCmpanies= Vacancy::leftJoin('companies', 'company_id', '=', 'name_company')
            ->select('company', 'company_id')
            ->where('name_company')
            ->get()->groupBy('company_id')->keys()->toArray();
        return $nameCmpanies;
    }

    function getCompanyDom(string $myHttps)
    {
        $client = new \GuzzleHttp\Client();
        return $client->request('GET', $myHttps);
    }




}




