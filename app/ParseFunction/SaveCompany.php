<?php

namespace app\ParseFunction;

use \App\Models\Company;

class SaveCompany
{

    function saveCompany(array $data, string $index)
    {

       // dump($data[$index]);
        foreach ($data[$index] as $keyParser => $value) {

            Company::updateOrCreate(
                ['name_company' => $index
                ],
                ['name_company' => $index,
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
        return 0;
    }

}

