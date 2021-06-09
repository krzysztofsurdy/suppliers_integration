<?php

declare(strict_types=1);

namespace Core\Infrastructure\API\Integration\Connector;

use Core\Domain\Integration\IntegrationProduct\AwesomeSixEleven\IntegrationProduct;
use Core\Infrastructure\API\Integration\AbstractJsonConnector;

class AwesomeSixElevenConnector extends AbstractJsonConnector
{
    protected function getIntegrationProductsData(): array
    {
        $jsonData = json_decode($this->getData(), true);

        $jsonData = $jsonData['list'];

        $result = [];

        foreach ($jsonData as $productData) {
            $product = new IntegrationProduct();
            $product = $product->injectArray($productData);
            $result[] = $product;
        }

        return $result;
    }
}
