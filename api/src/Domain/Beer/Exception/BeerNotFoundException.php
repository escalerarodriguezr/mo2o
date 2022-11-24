<?php
declare(strict_types=1);

namespace Mo2o\Domain\Beer\Exception;

class BeerNotFoundException extends \DomainException
{
    public static function fromId(int $id): self
    {
        throw new self(\sprintf('No beer found that matches the ID %d', $id));
    }

}