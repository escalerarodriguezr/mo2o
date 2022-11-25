<?php
declare(strict_types=1);

namespace Mo2o\Application\Beer\SearchBeer;

use Mo2o\Application\Beer\GetBeerById\GetBeerByIdQueryResponse;
use Mo2o\Domain\Beer\Repository\BeerFilter;
use Mo2o\Domain\Beer\Repository\BeerRepository;
use Mo2o\Domain\Shared\Bus\Query\QueryHandler;

class SearchQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly BeerRepository $beerRepository
    )
    {
    }

    /**
     * @param SearchBeerQuery $query
     * @return GetBeerByIdQueryResponse []
     */
    public function __invoke(
        SearchBeerQuery $query
    ): array
    {


        $beers = $this->beerRepository->searchByFilter(
            new BeerFilter(
                $query->filterByFood
            )
        );

        if( !count($beers) ){
            return [];
        }

        return array_map(fn($beer) => GetBeerByIdQueryResponse::fromModel($beer), $beers);

    }

}