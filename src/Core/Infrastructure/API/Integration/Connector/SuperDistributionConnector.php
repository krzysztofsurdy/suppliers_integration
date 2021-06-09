<?php

namespace Core\Infrastructure\API\Integration\Connector;

use Core\Infrastructure\API\Integration\AbstractXmlConnector;
use Core\Domain\Integration\IntegrationProduct\SuperDistribution\IntegrationProduct;
use Sabre\Xml\Deserializer;
use Sabre\Xml\Reader;

class SuperDistributionConnector extends AbstractXmlConnector
{
    protected function getXmlMap(): array
    {
        return [
            'items' => function (Reader $reader) {
                return Deserializer\repeatingElements($reader, '{}item');
            },
            '{}item' => IntegrationProduct::class
        ];
    }
}
