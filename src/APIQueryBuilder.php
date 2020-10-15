<?php

declare(strict_types=1);

namespace paha\SimpleBestBuy;


class APIQueryBuilder{

    const BASEURL = "https://api.bestbuy.com/v1/products";
    const APIFILE = __DIR__."/../api.json";

     /**
      * Builds a products query from this object
      *
      * @param array<string> $optionsToShow The options to retrieve from the query. sku or upc for instance. Use the static 
      * 'Enums' in from the Options class to assist with this.
      * @param string $restrictions The (optional) restrictions. Such as getting items before or after a certain date. Use the static
      * 'Enums' class t
      * @param integer $size The number of results to get. This can be between 1 and 100
      * @param string $sortBy The (optional) value to sort by.
      * @param string $sortOrder The sort order. Either asc or dsc.
      * @return string The query string that was built from the options passed in.
      */
    static function products(APIOptions $options): string
    {
        // Start the url building
        $url = APIQueryBuilder::BASEURL;

        // Add the restrictions if applicable
        if($options->restrictions != "")
            $url .= str_replace(" ", "%20", "($options->restrictions)");

        // Add the show options
        $url .= "?show=" . implode(",", $options->optionsToShow);

        // Add the sort options if applicable
        if($options->sortBy != "")
            $url .= "&sort=$options->sortBy.$options->sortOrder";

        $url .= "&pageSize=$options->pageSize";

        // Get the api key
        $apikey = APIQueryBuilder::getApiKey();
        // Add the API key
        $url .= "&format=json&apiKey=$apikey";

        return $url;
    }

    static function getApiKey():string
    {
        return json_decode(file_get_contents(APIQueryBuilder::APIFILE))->apikey;
    }
}

?>