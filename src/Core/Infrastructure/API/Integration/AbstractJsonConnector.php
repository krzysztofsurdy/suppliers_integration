<?php

namespace Core\Infrastructure\API\Integration;

use Core\Domain\Integration\IntegrationProductInterface;

abstract class AbstractJsonConnector extends AbstractConnector
{
    /**
     * @return IntegrationProductInterface[]
     */
    protected function getIntegrationProductsData(): array
    {
        return [];
    }
}
