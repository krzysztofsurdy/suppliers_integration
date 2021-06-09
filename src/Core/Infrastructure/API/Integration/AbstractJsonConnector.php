<?php

declare(strict_types=1);

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
