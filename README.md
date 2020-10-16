# Simple BestBuy API for PHP

This is a simple high-level PHP client for the [Best Buy developer API](https://developer.bestbuy.com/).

# Quickstart 

```PHP
$options = new APIOptions(); # Options to pass into APIQueryBuilder for building a URL
$options->restrictions = Options::salePrice()."<=29.99";

# The API object
$api = new BestBuyAPI();

# Fetch (up to) the first 100 results from the api
$results = $api->fetch(APIQueryBuilder::products($options));

# Fetch all results from the API
$results = $api->fetchAll(APIQueryBuilder::products($options), 1.0, 5);

# Checking for errors
if($results->error != "")
  handleError();
  
# Using the products returns from the API call
foreach($results->products as $product)
  doSomething();

# Getting a value from the raw json data from the API call
$totalPageSize = $results->rawData->totalPages;
```

# Dependencies
spatie/enum: "^3

# How to install


# Classes

## Options
The Options class contains around 400 static properties (accessed like Options::sku()) that
correspond to the available properties from the BestBuyAPI.


## APIOptions
The APIOptions class holds data to be passed in to the APIQueryBuilder to generate a URL to pass into the
BestBuyAPI class.

# APIQueryBuilder
The APIQueryBuilder is responsible for building a URL from the APIOptions.

## BestBuyAPI
Contains the methods ``fetch($url)`` and ``fetchAll($url, $delay, $numAttempts)`` to get data from the API. Usage is explained below

# Usage