<?php

namespace app\Functional;

use \App\Models\Vacancy;

class SaveParse
{

    function saveParseJob($data, $index)
    {
        $index = preg_replace("|[^0-9]|", "", $index);
        $i = 0;
        foreach ($data as $key => $value) {
            if (Vacancy::where('indexJobAion', $index)->first() == NULL) {
                Vacancy::insertGetId(
                    ['indexJobAion' => $index, 'httpAinua' => $key]
                );
            }
            foreach ($value as $key1 => $value1) {

                Vacancy::where('indexJobAion', $index)
                    ->update([$key1 => $value1]);
            }
            $i++;
        }
        return compact('data', 'index');
    }

}