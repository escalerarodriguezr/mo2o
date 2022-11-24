<?php
declare(strict_types=1);

namespace App\Controller\Beer;

use Mo2o\Application\Beer\GetBeerById\GetBeerByIdQuery;
use Mo2o\Domain\Shared\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetBeerByIdController
{


    public function __construct(
        private readonly QueryBus $queryBus
    )
    {
    }

    public function __invoke(int $id): Response
    {

        $response = $this->queryBus->handle(
            new GetBeerByIdQuery($id)
        );

        return new JsonResponse(
            $response->toArray(),
            Response::HTTP_OK
        );
    }


}