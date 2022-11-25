<?php
declare(strict_types=1);

namespace App\Controller\Beer;

use Mo2o\Application\Beer\SearchBeer\SearchBeerQuery;
use Mo2o\Domain\Shared\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetSearchBeerController
{


    public function __construct(
        private readonly QueryBus $queryBus
    )
    {
    }

    public function __invoke(Request $request): Response
    {
        $response = $this->queryBus->handle(
            new SearchBeerQuery(
                $request->get('food') ?? null
            )
        );

        return new JsonResponse(
            $response,
            Response::HTTP_OK
        );

    }

}