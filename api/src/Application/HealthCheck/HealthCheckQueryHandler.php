<?php
declare(strict_types=1);

namespace Mo2o\Application\HealthCheck;

use Mo2o\Domain\Shared\Bus\Query\QueryHandler;

class HealthCheckQueryHandler implements QueryHandler
{
    public function __invoke(
        HealthCheckQuery $query
    ): int
    {
        return $query->id;
    }


}