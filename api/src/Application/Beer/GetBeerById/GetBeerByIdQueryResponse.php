<?php
declare(strict_types=1);

namespace Mo2o\Application\Beer\GetBeerById;

use Mo2o\Domain\Beer\Model\Beer;

class GetBeerByIdQueryResponse
{

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $tagline,
        public readonly string $first_brewed,
        public readonly string $description,
        public readonly string $image_url
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tagline' => $this->tagline,
            'first_brewed' => $this->first_brewed,
            'description' => $this->description,
            'image_url' => $this->image_url
        ];
    }

    public static function fromModel(Beer $beer): self
    {
        return new GetBeerByIdQueryResponse(
            $beer->getId(),
            $beer->getName(),
            $beer->getTagline(),
            $beer->getFirstBrewed(),
            $beer->getDescription(),
            $beer->getImageUrl()
        );
    }
}