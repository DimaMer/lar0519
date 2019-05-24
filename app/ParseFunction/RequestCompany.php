<?php

namespace app\ParseFunction;
use App\Models\Vacancy;
use App\Models\Company;
class RequestCompany
{

   function getCompaniesLink()
    {
        $nameCmpanies= Vacancy::leftJoin('companies', 'company_id', '=', 'url_parent_site')
            ->select('company', 'company_id')
            ->where('url_parent_site')
            ->get()->groupBy('company_id')->keys()->toArray();

      return $nameCmpanies;
    }

    function getCompanyDom(string $myHttps)
    {
        $client = new \GuzzleHttp\Client();
        return $client->request('GET', $myHttps);
    }




}




