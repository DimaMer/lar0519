<?php

namespace app\ParseFunction;


class ParseCompany
{
    const PATH_CLASSES = '//*[@class="%s"]';

    function getParseCompany($dom, string $link, array $configure)
    {
        foreach ($configure as $key => $srchC) {
            $dataParser[$link][$key] = $this->getCompany($dom, $srchC['class'], $srchC['atr']);
        }
        return $dataParser;
    }


    private function getCompany($dom, $searchClasses, string $atr)
    {

        $doc = new \DOMDocument;
        @$doc->loadHTML($dom->getBody());
        $xpath = new \DOMXpath($doc);
        $list = $xpath->query(sprintf(self::PATH_CLASSES, $searchClasses));

//        $list = $xpath->query("//*[@class='" . $searchClasses . "']");


        if (is_object($list[0])) {
            if ($atr == 'href') {
                return $list[0]->getAttribute('href');
            }
            if ($atr == 'nextparent') {
                return $list[0]->getAttribute('href');
            }
            return $list[0]->nodeValue;
        }
        return NULL;
    }

}

