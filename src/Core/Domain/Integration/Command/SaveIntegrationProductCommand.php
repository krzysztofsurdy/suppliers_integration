<?php

namespace Core\Domain\Integration\Command;

use Core\Domain\Integration\IntegrationProductInterface;

class SaveIntegrationProductCommand
{
    private IntegrationProductInterface $integrationProduct;

    public function __construct(IntegrationProductInterface $integrationProduct)
    {
        $this->integrationProduct = $integrationProduct;
    }

    public function getIntegrationProduct(): IntegrationProductInterface
    {
        return $this->integrationProduct;
    }
}
