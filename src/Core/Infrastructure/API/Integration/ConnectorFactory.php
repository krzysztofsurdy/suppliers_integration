<?php

declare(strict_types=1);

namespace Core\Infrastructure\API\Integration;

use Core\Domain\Integration\Integration;
use Core\Infrastructure\API\Integration\Connector\AwesomeSixElevenConnector;
use Core\Infrastructure\API\Integration\Connector\SuperDistributionConnector;
use Core\Infrastructure\API\Integration\Connector\XYZLogisticsConnector;

class ConnectorFactory
{
    public function getConnector(Integration $integration): AbstractConnector
    {
        $configuration = self::loadConfiguration();
        if (isset($configuration[$integration->getSupplierName()])) {
            $connectorClass = $configuration[$integration->getSupplierName()];

            return new $connectorClass($integration->getSource(), $integration->getOptions());
        }

        throw ConnectorException::unsupportedSupplier($integration->getSupplierName());
    }

    protected static function loadConfiguration(): array
    {
        return [
            ConnectorConfigurationDictionary::XYZLOGISTICS()->getValue() => XYZLogisticsConnector::class,
            ConnectorConfigurationDictionary::SUPERDISTRIBUTION()->getValue() => SuperDistributionConnector::class,
            ConnectorConfigurationDictionary::AWESOMESIXELEVEN()->getValue() => AwesomeSixElevenConnector::class
        ];
    }
}
