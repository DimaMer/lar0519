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


    }

}

