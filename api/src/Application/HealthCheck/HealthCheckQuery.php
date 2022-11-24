<?php
declare(strict_types=1);

namespace Mo2o\Application\HealthCheck;

use Mo2o\Domain\Shared\Bus\Query\Query;

class HealthCheckQuery implements Query
{

    public function __construct(
        public readonly int $id
    )
    {
    }
}