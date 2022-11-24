<?php
declare(strict_types=1);

namespace App\Controller\HealthCheck;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckController
{

    public function __construct(
        private readonly LoggerInterface $logger
    )
    {
    }

    public function __invoke(): Response
    {
        $this->logger->info('Test is ok');
        return new JsonResponse(
            ['test' => 1],
           Response::HTTP_OK
        );
    }

}