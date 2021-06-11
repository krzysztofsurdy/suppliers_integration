<?php

declare(strict_types=1);

namespace Core\Domain\Integration\QueryHandler;

use Core\Domain\Integration\Integration;
use Core\Domain\Integration\IntegrationDTO;
use Core\Domain\Integration\IntegrationProductCollection;
use Core\Domain\Integration\Query\GetIntegrationProductsQuery;
use Core\Infrastructure\API\Integration\ConnectorFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetIntegrationProductsQueryHandler implements MessageHandlerInterface
{
    private ConnectorFactory $connectorFactory;

    public function __construct(ConnectorFactory $connectorFactory)
    {
        $this->connectorFactory = $connectorFactory;
    }

    public function __invoke(GetIntegrationProductsQuery $query): IntegrationProductCollection
    {
        $integrationDto = new IntegrationDTO();
        $integrationDto->source = $query->getSource();
        $integrationDto->supplierName = $query->getSupplierName();
        $integrationDto->options = $query->getOptions();

        $integration = new Integration($integrationDto);
        $connector = $this->connectorFactory->getConnector($integration);

        return $connector->getIntegrationProducts();
    }
}
