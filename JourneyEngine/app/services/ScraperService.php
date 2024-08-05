<?php

namespace App\Services;
use DOMDocument;
use DOMXPath;
class ScraperService
{

    public function scrapeNews($url)
    {


        $curl_handle = curl_init($url);

        $set_curl_option = curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        $CE = curl_exec($curl_handle);

        curl_exec($curl_handle);

        if (curl_error($curl_handle)) {
            echo curl_error($curl_handle);
            exit;
        }

        curl_close($curl_handle);

        $dom_document = new DOMDocument();

        $dom_document->loadHTML($CE);

        libxml_clear_errors();

        if (!$dom_document) {
            echo "Errors Parsing the HTML File.";
            exit;
        }

        $dom_xpath = new DOMXPath($dom_document);

        $scraped_data = $dom_xpath->query('//a[@class="tag"]');

        foreach ($scraped_data as $data) {
            echo $data->nodeValue . "\n";
        }
    }
}
