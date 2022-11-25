<?php
declare(strict_types=1);

namespace Mo2o\Infrastructure\Repository\PunkApi\Beer;

use Mo2o\Domain\Beer\Exception\BeerNotFoundException;
use Mo2o\Domain\Beer\Model\Beer;
use Mo2o\Domain\Beer\Repository\BeerFilter;
use Mo2o\Domain\Beer\Repository\BeerRepository;
use Mo2o\Infrastructure\Repository\PunkApi\Exception\PunkApiException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PunkApiBeerRepository implements BeerRepository
{
    const BASE_END_POINT = 'https://api.punkapi.com/v2/beers';

    public function __construct(
        private readonly HttpClientInterface $client
    )
    {
    }

    public function findById(int $id): Beer
    {
        $response = $this->client->request(
            Request::METHOD_GET,
            sprintf('%s/%d',self::BASE_END_POINT,$id)
        );

        $statusCode = $response->getStatusCode();

        if( $statusCode == 404){
            BeerNotFoundException::fromId($id);
        }

        if( $statusCode != 200 ){
            PunkApiException::fromHttpClient($statusCode);
        }

        return self::beerInfrastructureToModel(
            $response->toArray()[0]
        );

    }

    public function searchByFilter(BeerFilter $filter): array
    {
        $searchEndPoint = self::BASE_END_POINT;

        if( !empty($filter->filterByFood) ){
            $searchEndPoint .= '?food='. $filter->filterByFood;
        }

        $response = $this->client->request(
            Request::METHOD_GET,
            $searchEndPoint
        );

        $statusCode = $response->getStatusCode();


        if( $statusCode != 200 ){
            PunkApiException::fromHttpClient($statusCode);
        }

        $beerArray = $response->toArray();

        if( !count($beerArray) ){
            return [];
        }

        return array_map(fn($beer) => self::beerInfrastructureToModel($beer), $beerArray);

    }

    public static function beerInfrastructureToModel(array $beer): Beer
    {
        return new Beer(
            $beer['id'],
            $beer['name'],
            $beer['tagline'],
            $beer['first_brewed'],
            $beer['description'],
            $beer['image_url'],
        );
    }
}