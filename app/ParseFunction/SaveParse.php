<?php

namespace app\ParseFunction;

use \App\Models\Vacancy;

class SaveParse
{

    function saveParseJob(array $data, string $index)
    {
        $idJob = preg_replace("|[^0-9]|", "", $index);

        foreach ($data[$index] as $keyParser => $value) {
            Vacancy::updateOrCreate(
                ['indexjob' => $idJob
                ],
                ['indexjob' => $idJob,
                    'httpjob' => $index,
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
        return compact('data', 'idJob');
    }

}

