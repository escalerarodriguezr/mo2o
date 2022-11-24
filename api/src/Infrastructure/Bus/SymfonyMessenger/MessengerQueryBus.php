<?php
declare(strict_types=1);

namespace Mo2o\Infrastructure\Bus\SymfonyMessenger;

use Mo2o\Domain\Shared\Bus\Query\Query;
use Mo2o\Domain\Shared\Bus\Query\QueryBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(
        MessageBusInterface $queryBus
    )
    {
        $this->messageBus = $queryBus;
    }

    public function handle(
        Query $query
    ): mixed
    {
        return $this->handleQuery($query);
    }


}