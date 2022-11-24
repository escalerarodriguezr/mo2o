<?php
declare(strict_types=1);

namespace Mo2o\Domain\Beer\Repository;

use Mo2o\Domain\Beer\Model\Beer;

interface BeerRepository
{
    public function findById(int $id): Beer;

}