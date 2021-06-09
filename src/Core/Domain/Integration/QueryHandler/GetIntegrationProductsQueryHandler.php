<?php

declare(strict_types=1);

namespace Core\Domain\Integration\QueryHandler;

use Core\Domain\Integration\Integration;
use Core\Domain\Integration\IntegrationDTO;
use Core\Domain\Integration\IntegrationProductCollection;
use Core\Domain\Integration\Query\GetIntegrationProductsQuery;
use Core\Infrastructure\API\Integration\ConnectorFactory;
use Core\Shared\Dictionary\SupplierNameEnum;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetIntegrationProductsQueryHandler implements MessageHandlerInterface
{
    public function __invoke(GetIntegrationProductsQuery $query): IntegrationProductCollection
    {
        $integrationDto = new IntegrationDTO();
        $integrationDto->source = $query->getSource();
        $integrationDto->supplierName = new SupplierNameEnum($query->getSupplierName());
        $integrationDto->options = $query->getOptions();

        $integration = new Integration($integrationDto);
        $connector = ConnectorFactory::getConnector($integration);

        return $connector->getIntegrationProducts();
    }
}
