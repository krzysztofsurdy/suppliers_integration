<?php

declare(strict_types=1);

namespace Core\Application\Service;

use Core\Domain\Integration\Command\SaveIntegrationProductCommand;
use Core\Domain\Integration\IntegrationProductCollection;
use Core\Domain\Integration\Query\GetIntegrationProductsQuery;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class IntegrationService
{
    private MessageBusInterface $messageBus;
    private LoggerInterface $logger;

    public function __construct(MessageBusInterface $messageBus, LoggerInterface $logger)
    {
        $this->messageBus = $messageBus;
        $this->logger = $logger;
    }


    public function runIntegration(
        string $source,
        string $supplierName,
        array $options = []
    ): IntegrationProductCollection {

        $this->logger->info(
            sprintf('Integration started for supplier %s with source %s', $supplierName, $source)
        );

        $envelope = $this->messageBus->dispatch(new GetIntegrationProductsQuery($source, $supplierName, $options));
        /** @var HandledStamp $handledStamp */
        $handledStamp = $envelope->last(HandledStamp::class);
        /** @var IntegrationProductCollection $integrationProducts */
        $integrationProducts = $handledStamp->getResult();

        foreach ($integrationProducts->getAll() as $integrationProduct) {
            $this->messageBus->dispatch(new SaveIntegrationProductCommand($integrationProduct));
        }

        $this->logger->info(
            sprintf('Integration finished for supplier %s with source %s', $supplierName, $source)
        );

        return $handledStamp->getResult();
    }
}
