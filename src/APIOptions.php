<?php

declare(strict_types=1);

namespace paha\BestBuyAPI;

class APIOptions{
    public string $restrictions="";
    public array $optionsToShow=[];
    public string $sortBy="";
    public string $sortOrder="asc";
    public int $pageSize=100;
    public int $MaxResults=-1;
}


?>