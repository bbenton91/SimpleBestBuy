# Simple BestBuy API for PHP

This is a simple high-level PHP client for the [Best Buy developer API](https://developer.bestbuy.com/).

# Table of Contents
1. [Quickstart](#quickstart)
2. [Introduction](#introduction)
4. [How to Install](#how-to-install)
    1. [Dependencies](#dependencies)
    2. [From github](#from-github)
5. [Usage](#usage)
    1. [ProductOptions](#productoptions)
    2. [APIOptions](#apioptions)
    3. [APIQueryBuilder]($apiquerybuilder)
    4. [BestBuyAPI](#bestbuyapi)
6. [Roadmap](#roadmap)



# Quickstart 

```PHP
$options = new APIOptions(); # ProductOptions to pass into APIQueryBuilder for building a URL
$options->restrictions = ProductOptions::salePrice()."<=29.99";

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

# Introduction



# How to install
### Dependencies
spatie/enum: "^3

### From github


# Usage

### ProductOptions
The ProductOptions class contains around 400 static properties (accessed like ProductOptions::sku()) that
correspond to the available properties from the BestBuyAPI. These are used to show parameters
for the returned products or to refine searches. Quick usage:

```PHP
$optionsToShow = [ProductOptions::sku(), ProductOptions::name(), ProductOptions::startDate()];
$refineSearch = ProductOptions::salePrice."<=29.99";
```

### APIOptions
The APIOptions class holds data to be passed in to the APIQueryBuilder to generate a URL to pass into the
BestBuyAPI class. The use of ProductOptions to help build this data is recommended. Quick usage:

```PHP
$options = new APIOptions();
$options->restrictions = ProductOptions::salePrice."<=29.99";
$options->optionsToShow = [ProductOptions::sku(), ProductOptions::name(), ProductOptions::startDate()]
```

### APIQueryBuilder
The APIQueryBuilder is responsible for building a URL from the APIOptions. It will return a string URL that can be passed
in to the BestBuyAPI methods. Quick usage:
```PHP
$options = new APIOptions();
$options->restrictions = ProductOptions::salePrice."<=29.99";
$options->optionsToShow = [ProductOptions::sku(), ProductOptions::name(), ProductOptions::startDate()]

$url = APIQueryBuilder::products($options);
```

### BestBuyAPI
Contains the methods ``fetch($url)`` and ``fetchAll($url, $delay, $numAttempts)`` to get data from the API.

The ``fetch($url)`` method will return an object containing ``string $error``, ``array $products``, and ``object rawData``.

  - *The ``$error`` is simply a string with the error message. Check ``$results->error === ""`` to validate no error.*
  - *The ``$products`` object is an array of up to 100 returned products from the API call. Refer to the [BestBuy Products API](https://bestbuyapis.github.io/api-documentation/#products-api)
  documentation for further information.*
  - *The ``$rawData`` is the json object returned from the API call. This can be used to get information like total pages from the response.
  Refer to [the response format](https://bestbuyapis.github.io/api-documentation/#response-format) for more information.*

The ``fetchAll(string $url, float $delayBetweenCalls, int $numAttempts)`` will attempt to fetch all results using the cursor mark from each call.
The $delayBetweenCalls parameter sleeps the function between each API call. Use this to prevent reaching the call per second limit.
This differs from the regular ``fetch()`` call in the following ways:

  - *The ``$error`` will only contain the most recent error during the call.*
  - *The ``$products`` will contain as many products as the ``fetchAll()`` call gathered.*
  - *The ``$rawData`` object will only contain the data from the most last call before finishing.*

The $url should be created from the APIQueryBuilder which will handle building and inclusion of the API key. A custom
url can be used if desired. Quick usage:

```PHP
$timeBetweenCalls = 1.0;
$numAttempts = 5; 

$url = APIQueryBuilder::products($options);

$api = new BestBuyAPI();

$results = $api->fetch($url);
# or
$results = $api->fetchAll($url, $timeBetweenCalls, $numAttempts);

# Checking for errors
if($results->error != "")
  handleError();
  
# Using the products returns from the API call. Up to 100 when using fetch()
foreach($results->products as $product)
  doSomething();

# Getting a value from the raw json data from the API call
$totalPageSize = $results->rawData->totalPages;

```

# Roadmap

- Implement availability
- Implement categories
- Implement open box products
- Implement product recommendations
- Implement products reviews
- Implement stores