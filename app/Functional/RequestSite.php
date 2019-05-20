<?php

namespace app\Functional;

class RequestSite
{

   function getJobDom( $myHttps)
    {
        $client = new \GuzzleHttp\Client();
        return $client->request('GET', $myHttps);
    }

      function getLinkJob( $https, $count){
        $client = new \GuzzleHttp\Client();
        for ($i = 1; $i < 100; $i++) {
            $response = $client->request('GET', $https . "page/" . $i . "/");
            $className = 'post-link';
            $doc = new \DOMDocument;
            @$doc->loadHTML($response->getBody());
            $xpath = new \DOMXpath($doc);
            $list = $xpath->query("//*[@class='" . $className . "']");

            foreach ($list as $a_tag) {
                $href = $a_tag->getAttribute('href');
                $myHttps[] = $href;
                $count--;
                if ($count <= 0) return $myHttps;
            }
        }
        return $myHttps;
    }
}




