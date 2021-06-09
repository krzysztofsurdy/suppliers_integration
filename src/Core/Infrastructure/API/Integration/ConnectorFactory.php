<?php

declare(strict_types=1);

namespace Core\Infrastructure\API\Integration;

use Core\Domain\Integration\Integration;
use Core\Infrastructure\API\Integration\Connector\AwesomeSixElevenConnector;
use Core\Infrastructure\API\Integration\Connector\SuperDistributionConnector;
use Core\Infrastructure\API\Integration\Connector\XYZLogisticsConnector;
use Core\Shared\Dictionary\SupplierNameEnum;

class ConnectorFactory
{
    public static function getConnector(Integration $integration): AbstractConnector
    {
        $configuration = self::loadConfiguration();
        if (isset($configuration[$integration->getSupplierName()->getValue()])) {
            $connectorClass = $configuration[$integration->getSupplierName()->getValue()];

            return new $connectorClass($integration->getSource(), $integration->getOptions());
        }

        throw ConnectorException::unsupportedSupplier($integration->getSupplierName()->getValue());
    }

    private static function loadConfiguration(): array
    {
        return [
            SupplierNameEnum::XYZLOGISTICS()->getValue() => XYZLogisticsConnector::class,
            SupplierNameEnum::SUPERDISTRIBUTION()->getValue() => SuperDistributionConnector::class,
            SupplierNameEnum::AWESOMESIXELEVEN()->getValue() => AwesomeSixElevenConnector::class
        ];
    }
}
