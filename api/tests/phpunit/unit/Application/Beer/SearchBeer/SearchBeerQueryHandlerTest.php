<?php
declare(strict_types=1);

namespace PHPUnit\Tests\unit\Application\Beer\SearchBeer;

use Mo2o\Application\Beer\GetBeerById\GetBeerByIdQueryResponse;
use Mo2o\Application\Beer\SearchBeer\SearchBeerQuery;
use Mo2o\Application\Beer\SearchBeer\SearchBeerQueryHandler;
use Mo2o\Domain\Beer\Model\Beer;
use Mo2o\Domain\Beer\Repository\BeerFilter;
use Mo2o\Domain\Beer\Repository\BeerRepository;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;

class SearchBeerQueryHandlerTest extends TestCase
{
    private MockBuilder|BeerRepository $beerRepository;

    private SearchBeerQueryHandler $searchBeerQueryHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->beerRepository = $this->getMockBuilder(BeerRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchBeerQueryHandler = new SearchBeerQueryHandler(
            $this->beerRepository
        );

    }

    public function testHandlerInvokeWithFilterByFood(): void
    {
        $query = new SearchBeerQuery('fakeFood');

        $beers = [
            new Beer(
                1,
                "FakeName",
                "FakeTagline",
                "FakeFirstBrewed",
                "FakeDescription",
                "FakeImageUrl"

            ),
            new Beer(
                2,
                "FakeName2",
                "FakeTagline2",
                "FakeFirstBrewed2",
                "FakeDescription2",
                "FakeImageUrl2"

            )
        ];

        $this->beerRepository->expects($this->exactly(1))
            ->method('searchByFilter')
            ->with(new BeerFilter($query->filterByFood))
            ->willReturn($beers);

        $response = $this->searchBeerQueryHandler->__invoke($query);
        
        self::assertSame(count($response),count($beers));
        list($first,$second) = $response;
        self::assertInstanceOf(GetBeerByIdQueryResponse::class, $first);
        self::assertInstanceOf(GetBeerByIdQueryResponse::class, $second);
        self::assertSame($first->id,$beers[0]->getId());
        self::assertSame($second->id,$beers[1]->getId());

    }

}