<?php
declare(strict_types=1);

namespace Mo2o\Infrastructure\Repository\PunkApi\Beer;

use Mo2o\Domain\Beer\Exception\BeerNotFoundException;
use Mo2o\Domain\Beer\Model\Beer;
use Mo2o\Domain\Beer\Repository\BeerRepository;
use Mo2o\Infrastructure\Repository\PunkApi\Exception\PunkApiException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class PunkApiBeerRepository implements BeerRepository
{

    public function __construct(
        private readonly HttpClientInterface $client
    )
    {
    }

    public function findById(int $id): Beer
    {
        $response = $this->client->request(
            'GET',
            sprintf('https://api.punkapi.com/v2/beers/%d', $id)
        );

        $statusCode = $response->getStatusCode();

        if( $statusCode == 404){
            BeerNotFoundException::fromId($id);
        }

        if( $statusCode != 200 ){
            PunkApiException::fromHttpClient($statusCode);
        }

        $content = $response->toArray()[0];

        return new Beer(
            $content['id'],
            $content['name'],
            $content['tagline'],
            $content['first_brewed'],
            $content['description'],
            $content['image_url'],
        );
    }

}