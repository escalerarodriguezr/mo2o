<?php
declare(strict_types=1);

namespace Mo2o\Domain\Beer\Model;

class Beer
{

    public function __construct(
        private int $id,
        private string $name,
        private string $tagline,
        private string $first_brewed,
        private string $description,
        private string $image_url
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }


    public function getFirstBrewed(): string
    {
        return $this->first_brewed;
    }


    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }



}