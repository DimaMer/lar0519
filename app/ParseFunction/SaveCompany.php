<?php

namespace app\ParseFunction;

use \App\Models\Company;

class SaveCompany
{

    function saveCompany(array $dataCompany, string $linkCompany)
    {

        foreach ($dataCompany[$linkCompany] as $keyParser => $value) {
            $value = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $value);
            Company::updateOrCreate(
                ['url_parent_site' => $linkCompany
                ],
                ['url_parent_site' => $linkCompany,
                    $keyParser => $value,
                ]
            );
        }
        return 0;
    }

}

