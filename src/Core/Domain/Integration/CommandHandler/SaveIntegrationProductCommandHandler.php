<?php


namespace Core\Domain\Integration\CommandHandler;


use Core\Domain\Integration\Command\SaveIntegrationProductCommand;
use Core\Domain\Integration\PersisterInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SaveIntegrationProductCommandHandler implements MessageHandlerInterface
{
    private PersisterInterface $persister;
    private LoggerInterface $logger;

    public function __construct(PersisterInterface $persister, LoggerInterface $logger)
    {
        $this->persister = $persister;
        $this->logger = $logger;
    }

    public function __invoke(SaveIntegrationProductCommand $command): void
    {
        $this->persister->saveIntegrationProduct($command->getIntegrationProduct());
        $this->logger->info(
            sprintf('Saved integration product %s', $command->getIntegrationProduct()->getId()),
            $command->getIntegrationProduct()->toArray()
        );
    }
}