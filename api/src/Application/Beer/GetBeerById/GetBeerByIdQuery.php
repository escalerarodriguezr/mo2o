<?php
declare(strict_types=1);

namespace Mo2o\Application\Beer\GetBeerById;

use Mo2o\Domain\Shared\Bus\Query\Query;

class GetBeerByIdQuery implements Query
{
    public function __construct(
        public readonly int $id
    )
    {
    }
}