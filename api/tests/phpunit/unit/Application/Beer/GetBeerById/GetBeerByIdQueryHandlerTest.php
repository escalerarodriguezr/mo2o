<?php
declare(strict_types=1);

namespace PHPUnit\Tests\unit\Application\Beer\GetBeerById;

use Mo2o\Application\Beer\GetBeerById\GetBeerByIdQuery;
use Mo2o\Application\Beer\GetBeerById\GetBeerByIdQueryHandler;
use Mo2o\Application\Beer\GetBeerById\GetBeerByIdQueryResponse;
use Mo2o\Domain\Beer\Model\Beer;
use Mo2o\Domain\Beer\Repository\BeerRepository;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;

class GetBeerByIdQueryHandlerTest extends TestCase
{
    private MockBuilder|BeerRepository $beerRepository;

    private GetBeerByIdQueryHandler $getBeerByIdQueryHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->beerRepository = $this->getMockBuilder(BeerRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->getBeerByIdQueryHandler = new GetBeerByIdQueryHandler(
            $this->beerRepository
        );

    }

    public function testHandlerInvoke(): void
    {
        $query = new GetBeerByIdQuery(1);

        $beer = new Beer(
            1,
            "FakeName",
            "FakeTagline",
            "FakeFirstBrewed",
            "FakeDescription",
            "FakeImageUrl"

        );

        $this->beerRepository->expects($this->exactly(1))
            ->method('findById')
            ->with($query->id)
            ->willReturn($beer);

        $response = $this->getBeerByIdQueryHandler->__invoke($query);

        self::assertInstanceOf(GetBeerByIdQueryResponse::class, $response);
        self::assertSame($response->id,$beer->getId());
        self::assertSame($response->name,$beer->getName());
        self::assertSame($response->tagline,$beer->getTagline());
        self::assertSame($response->first_brewed,$beer->getFirstBrewed());
        self::assertSame($response->image_url,$beer->getImageUrl());

    }


}