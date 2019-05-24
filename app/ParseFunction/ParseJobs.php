<?php

namespace app\ParseFunction;


class ParseJobs
{
    const PATH_CLASSES= '//*[@class="%s"]';

    function getParseJob(object $dom, string $link, array $configure)
    {
        foreach ($configure as $key => $srchC) {
            $dataParser[$link][$key] = $this->getJob($dom, $srchC, 'class');

        }
        $dataParser[$link]['company_id'] = $this->getJob($dom, 'company-title', 'href');
        return $dataParser;
    }


    private function getJob(object $dom, string $searchClasses, $atr)
    {

        $doc = new \DOMDocument;
        @$doc->loadHTML($dom->getBody());
        $xpath = new \DOMXpath($doc);
        $list = $xpath->query(sprintf(self::PATH_CLASSES, $searchClasses));
        //$list = $xpath->query("//*[@class='" . $searchClasses . "']");
        if ($atr=='href') {return $list[0]->getAttribute('href'); }
        if (is_object($list[0])) {
            return $list[0]->nodeValue;
        }
        return NULL;
    }

}


