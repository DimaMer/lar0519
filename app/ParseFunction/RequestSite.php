<?php
namespace app\ParseFunction;
class RequestSite
{
    const PATH_CLASSES= '//*[@class="%s"]';
    function getJobDom(string $myHttps)
    {
        $client = new \GuzzleHttp\Client();
        return $client->request('GET', $myHttps);
    }
    function getLinkJob( $https, $count){
        $client = new \GuzzleHttp\Client();
        for ($i = 1; $i < 10000; $i++) {
            $response = $client->request('GET', $https . "page/" . $i . "/");
            $className = 'post-link';
            $doc = new \DOMDocument;
            @$doc->loadHTML($response->getBody());
            $xpath = new \DOMXpath($doc);
            //$list = $xpath->query("//*[@class='" . $className . "']");
            $list = $xpath->query(sprintf(self::PATH_CLASSES, $className));

            $list = $xpath->query("/html/body//div/li//div/a/@href");

            foreach ($list as $a_tag) {
                $href = $a_tag->nodeValue;
                $myHttps[] = $href;


                $count--;
                if ($count <= 0)
                {return $myHttps;}
            }
        }
        return $myHttps;
    }
}