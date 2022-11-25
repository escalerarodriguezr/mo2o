<?php
declare(strict_types=1);

namespace Mo2o\Application\Beer\GetBeerById;

use Mo2o\Domain\Beer\Repository\BeerRepository;
use Mo2o\Domain\Shared\Bus\Query\QueryHandler;

class GetBeerByIdQueryHandler implements QueryHandler
{

    public function __construct(
        private readonly BeerRepository $beerRepository
    )
    {
    }

    public function __invoke(
        GetBeerByIdQuery $query
    ): GetBeerByIdQueryResponse
    {

        $beer = $this->beerRepository->findById(
            $query->id
        );

        return GetBeerByIdQueryResponse::fromModel($beer);
    }

}