<?php
declare(strict_types=1);

namespace Mo2o\Application\Beer\SearchBeer;

use Mo2o\Domain\Shared\Bus\Query\Query;

class SearchBeerQuery implements Query
{

    public function __construct(
        public readonly ?string $filterByFood
    )
    {
    }
}