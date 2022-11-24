<?php
declare(strict_types=1);

namespace App\Controller\HealthCheck;

use Mo2o\Application\HealthCheck\HealthCheckQuery;
use Mo2o\Domain\Shared\Bus\Query\QueryBus;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckController
{

    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly QueryBus $queryBus
    )
    {
    }

    public function __invoke(
        Request $request
    ): Response
    {
        $this->logger->info('Test is ok');

        $response = $this->queryBus->handle(
            new HealthCheckQuery((int)$request->get('id') ?? 0)
        );

        return new JsonResponse(
            ['queryId' => $response],
           Response::HTTP_OK
        );
    }

}