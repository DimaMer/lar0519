<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ParseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job.temp');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function addToDatabase($base, $data,$index)
    {


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
        

    }




// private or public?
    private function parseLinkVacancy($https, $count)
    {
// потрібно визвати нев ще раз чи передати як параметер у функцію?
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
                if ($count<=0) return $myHttps;
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo $request->name;////


        $https = 'https://ain.ua/jobs/vacancy/';
        $myHttps = [];
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

        if ($request->class!=NULL){$searchClasses=($request->class);} //як краще обнулити обєкт?
        $dataAfterSearch = [];

        header('Content-Type: text/html; utf-8; charset=UTF-8');


        $myHttps = static::parseLinkVacancy($https, $request->name); //в одному контролері чи перекидувати в інші файли. статік це вірно чи якось по другому.
        $client = new \GuzzleHttp\Client();

        foreach ($myHttps as $htp) {    //оптимально?
            $response = $client->request('GET', $htp);
            $index[] = preg_replace("|[^0-9]|", "", $htp);
            foreach ($searchClasses as $key=>$srchC) {

                $dataAfterSearch[$htp][$key] = static::parseJob($response, $srchC);
            }
        }

        //-----------------------------------------------------------

static::addToDatabase('vacancy_parser',$dataAfterSearch,$index);


        // return view('job.viewTemp')->with('dataAfterSearch',$dataAfterSearch);
        return view('job.viewTemp', compact('dataAfterSearch','index'));
        //як краще?
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'j3';//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo 'j4';//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo 'j5';//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
