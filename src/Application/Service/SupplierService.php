<?php

declare(strict_types=1);

namespace Application\Service;

use Core\Domain\Supplier\Query\GetSupplierByNameQuery;
use Core\Domain\Supplier\Supplier;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class SupplierService
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function getSupplierByName(string $name): ?Supplier
    {
        $envelope = $this->messageBus->dispatch(new GetSupplierByNameQuery($name));
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }
}
