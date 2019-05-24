<?php

namespace app\ParseFunction;

use \App\Models\Vacancy;

class SaveJob
{

    function saveParseJob(array $dataJob, string $linkJob)
    {
        $idJob = preg_replace("|[^0-9]|", "", $linkJob);
        foreach ($dataJob[$linkJob] as $keyParser => $value) {
            $value = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $value); //del space

            Vacancy::updateOrCreate(
                ['indexjob' => $idJob
                ],
                ['indexjob' => $idJob,
                    'httpjob' => $linkJob,
                    $keyParser => $value,
                ]
            );
        }


//        foreach ($data as $key => $value) {
//            if (Vacancy::where('indexjob', $index)->first() == NULL) {
//                Vacancy::insertGetId(
//                    ['indexjob' => $index, 'httpjob' => $key]
//                );
//            }
//            foreach ($value as $key1 => $value1) {
//
//                Vacancy::where('indexjob', $index)
//                    ->update([$key1 => $value1]);
//            }
//        }
        //return compact('data', 'idJob');
    }

}

