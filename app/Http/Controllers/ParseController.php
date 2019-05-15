<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ParseController extends Controller
{

// private or public?
    private function parseLinkVacancy($https, $count)
    {
// потрібно визвати new ще раз чи передати як параметер у функцію?
        $client = new \GuzzleHttp\Client();

        for ($i = 1; $i < 100; $i++) {
            $response = $client->request('GET', $https . "page/" . $i . "/");
            $className = 'post-link';
            $doc = new \DOMDocument;
            @$doc->loadHTML($response->getBody());
            $xpath = new \DOMXpath($doc);
            $list = $xpath->query("//*[@class='" . $className . "']");

            foreach ($list as $a_tag) {

                $href = $a_tag->getAttribute('href');
                $myHttps[] = $href;
                $count--;
                if ($count <= 0) return $myHttps;
            }
        }
        return $myHttps;
    }

    public function parseJob($dom, $link)
    {
        $doc = new \DOMDocument;
        @$doc->loadHTML($dom->getBody());
        $xpath = new \DOMXpath($doc);
        $list = $xpath->query("//*[@class='" . $link . "']");
        if (is_object($list[0])) {
            return $list[0]->nodeValue;
        }
        return NULL;
    }

    public function index()
    {
        return view('job.selectParse');
    }

    public function create()
    {
echo'create';
    }
//------------------------------------------------------------

    public function store(Request $request)
    {
        //echo $request->name;
        $https = 'https://ain.ua/jobs/vacancy/';
        //$myHttps = [];
        $index = [];
        $searchClasses = [
            'vacancy' => 'vacancy-title',
            'company' => 'company-title',
            'time' => 'time-passed',
            'vacancyInfoWrapper' => 'vacancy-info-wrapper vacancy-block post',
            'companyDescription' => 'company-description vacancy-block post',
            'category' => 'selected-category',
            'cityVacancyCity' => 'selected-city vacancy-city'
        ];

        if ($request->class != NULL) {
            $searchClasses = $request->class;
        } //як краще обнулити ?
        $dataAfterSearch = [];
        header('Content-Type: text/html; utf-8; charset=UTF-8');

        $myHttps = static::parseLinkVacancy($https, $request->name); //в одному контролері чи перекидувати в інші файли. статік це вірно чи якось по другому.
        $client = new \GuzzleHttp\Client();

        foreach ($myHttps as $htp) {    //оптимально?
            $response = $client->request('GET', $htp);
            $index[] = preg_replace("|[^0-9]|", "", $htp);
            foreach ($searchClasses as $key => $srchC) {

                $dataAfterSearch[$htp][$key] = static::parseJob($response, $srchC);
            }
        }

        session()->flash('flesh', array('data' => $dataAfterSearch, 'index' => $index)); // Store it as flash data


        // return view('job.afterParse')->with('data',$dataAfterSearch);
        // //як краще?
        $data = $dataAfterSearch;
        return view('job.afterParse', compact('data', 'index'));

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
