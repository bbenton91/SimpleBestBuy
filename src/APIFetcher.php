<?php

namespace paha\BestBuyAPI;

/**
 * Simple interface to enforce the fetch and fetchAll functions
 */
interface APIFetcher{
    /**
     * Fetches a single api call.
     *
     * @param string $url The url to call to BestBuy's api. This should be built by the APIQueryBuilder::products function
     * @return object An object that contains the API data fetched. Contains:
     * 
     * ->error: If blank, there was no error. Otherwise, contains the message from the API fetch error
     * 
     * ->products: The list of products from the API call. Refer to BestBuy's API documentation for returned objects
     * 
     * ->rawDat: The raw data from the API call. This will be decoded json and contains errors, products, pages, etc. Refer to BestBuy's API documentation for more information.
     */
    function fetch(string $url):object;

    /**
     * Fetches all results possible from an API call started by the passed in URL. This will use the page cursor to traverse the results
     *
     * @param string $url The url to call to BestBuy's api. This should be built by the APIQueryBuilder::products function
     * @param float $delayBetweenCalls The delay between API calls. Use this to not exceed the API queries per second limit
     * @param integer $numberOfAttempts The number of failed attempts to have before returning early. Ex: A value of 3 means that 3 failed attempts to the API call 
     * have to happen to return early. This can be caused by API query limits or other errors in the URL.
     * @return object An object that contains the API data fetched. Contains:
     * 
     * ->error: If blank, there was no error. Otherwise, contains the message from the API fetch error
     * 
     * ->products: The list of products from the API call. Refer to BestBuy's API documentation for returned objects
     * 
     * ->rawDat: The raw data from the API call. This will be decoded json and contains errors, products, pages, etc. Refer to BestBuy's API documentation for more information.
     */
    function fetchAll(string $url, float $delayBetweenCalls, int $numberOfAttempts):object;
}

?>