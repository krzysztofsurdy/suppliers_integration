<?php

namespace Core\Infrastructure\API\Integration\Connector;

use Core\Infrastructure\API\Integration\AbstractXmlConnector;
use Core\Domain\Integration\IntegrationProduct\XYZLogistics\IntegrationProduct;
use Sabre\Xml\Deserializer;
use Sabre\Xml\Reader;

class XYZLogisticsConnector extends AbstractXmlConnector
{
    protected function getXmlMap(): array
    {
        return [
            'products' => function (Reader $reader) {
                return Deserializer\repeatingElements($reader, '{}product');
            },
            '{}product' => IntegrationProduct::class
        ];
    }
}
