<?php

namespace paha\SimpleBestBuy;

use ErrorException;
use Exception;

class BestBuyAPI implements APIFetcher{

    public function __construct() {

    }

    function fetch(string $url):object
    {
        set_error_handler(
            function ($severity, $message, $file, $line) {
                throw new ErrorException($message, $severity, $severity, $file, $line);
            }
        );

        try{
            $json = file_get_contents($url); # Get data from the URL

            if(!$json) {
                return (object)['error'=>"Something went wrong", 'products'=>[], 'rawData'=>null];
            }

            $json = json_decode($json); # Decode its json
            if(!$json)
                return (object)['error'=>"Decoding json from the API called failed", 'products'=>[]];

            return (object)['error'=>"", 'products'=>$json->products, 'rawData'=>$json];
        }catch(Exception $e){
            $message = $e->getMessage();
            return (object)['error'=>"$message. Double check that your API key is correct.", 'products'=>[], 'rawData'=>null];
        }
    }

    function fetchAll(string $url, float $delayBetweenCalls, int $maxTries):object
    {
        $numErrors = 0;
        $totalResults = [];
        $lastError = "";
        $nextCursorMark="*";
        do {
            $results = $this->fetch($url."&cursorMark=".$nextCursorMark);
            $totalResults = array_merge($totalResults, $results->products);

            // If there is an error
            if($results->error != ""){
                $lastError = $results->error;
            }else{
                $nextCursorMark = $results->rawData->nextCursorMark ?? "";
            }

            // There are no more results when empty products and no errors
            $noMoreResults = count($results->products) == 0 && $results->error == "" || $nextCursorMark == "";
            sleep($delayBetweenCalls);
        } while (!$noMoreResults && $numErrors < $maxTries);

        return (object)['error'=>$lastError, 'products'=>$totalResults];
    }
}

?>