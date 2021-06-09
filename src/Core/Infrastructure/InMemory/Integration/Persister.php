<?php

declare(strict_types=1);

namespace Core\Infrastructure\InMemory\Integration;

use Core\Domain\Integration\IntegrationProductInterface;
use Core\Domain\Integration\PersisterInterface as DomainPerister;

class Persister implements DomainPerister
{
    private array $integrationProducts = [];

    public function saveIntegrationProduct(IntegrationProductInterface $integrationProduct): void
    {
        $this->integrationProducts[$integrationProduct->getId()] = Mapper::fromDomain($integrationProduct);
    }
}