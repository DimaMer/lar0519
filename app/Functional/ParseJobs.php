<?php

namespace app\Functional;


class ParseJobs
{

    function getParseJob($dom, $link, $configure)
    {
        foreach ($configure as $key => $srchC) {
            $dataParser[$link][$key] = static::getJob($dom, $srchC);
        }
        return $dataParser;
    }


    private function getJob($dom, $searchClasses)
    {
        $doc = new \DOMDocument;
        @$doc->loadHTML($dom->getBody());
        $xpath = new \DOMXpath($doc);
        $list = $xpath->query("//*[@class='" . $searchClasses . "']");
        if (is_object($list[0])) {
            return $list[0]->nodeValue;
        }
        return NULL;
    }

}