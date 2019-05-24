<?php

namespace app\ParseFunction;


class ParseCompany
{
    const PATH_CLASSES= '//*[@class="%s"]';

    function getParseCompany($dom, string $link, array $configure)
    {
        foreach ($configure as $key => $srchC) {

           // dump($link);
            $dataParser[$link][$key] = $this->getCompany($dom, $srchC, 'class');

        }
        //$dataParser[$link]['company_id'] = $this->getCompany($dom, 'company-title', 'href');
        return $dataParser;
    }


    private function getCompany( $dom,  $searchClasses, $atr)
    {

        $doc = new \DOMDocument;

        @$doc->loadHTML($dom->getBody());
//        dump ($doc);
        $xpath = new \DOMXpath($doc);
//        $list = $xpath->query(sprintf(self::PATH_CLASSES, $searchClasses));
        $list = $xpath->query("//*[@class='" . $searchClasses . "']");

        if (is_object($list[0])) {
          //  dump($list[0]->nodeValue);
            return $list[0]->nodeValue;
        }
        return NULL;
    }

}

