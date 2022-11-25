<?php
declare(strict_types=1);

namespace Mo2o\Domain\Beer\Repository;

class BeerFilter
{

    public function __construct(
        public readonly ?string $filterByFood
    )
    {
    }
}