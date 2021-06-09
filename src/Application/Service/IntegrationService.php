<?php

declare(strict_types=1);

namespace Application\Service;

use Core\Domain\Integration\IntegrationProductCollection;
use Core\Domain\Integration\Query\GetIntegrationProductsQuery;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class IntegrationService
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function getIntegrationProducts(
        string $source,
        string $supplierName,
        array $options = []
    ): IntegrationProductCollection {
        $envelope = $this->messageBus->dispatch(new GetIntegrationProductsQuery($source, $supplierName, $options));
        $handledStamp = $envelope->last(HandledStamp::class);

        return $handledStamp->getResult();
    }
}
