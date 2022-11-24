<?php

namespace Mo2o\Infrastructure\Repository\PunkApi\Exception;

class PunkApiException extends \Exception
{
    public static function fromHttpClient(int $statusCode): self
    {
        throw new self(\sprintf('Punk Api error response. Status Code: %d', $statusCode));
    }

}