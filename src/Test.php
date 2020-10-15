<?php

namespace paha\BestBuyAPI;

require __DIR__.'/../vendor/autoload.php';

$options = new APIOptions();
$options->restrictions = Options::startDate() .">=2020-10-06";
$options->optionsToShow = [Options::description(), Options::regularPrice(), Options::salePrice()];

$query =  APIQueryBuilder::productss($options);

echo $query;
echo "\n";

$api = new BestBuyAPI();
$result = $api->fetchAll($query, 500, 5);
echo $result->error;
echo count($result->products);

?>