<?php

declare(strict_types=1);

namespace Core\Domain\Integration;

interface PersisterInterface
{
    public function saveIntegrationProduct(IntegrationProductInterface $integrationProduct): void;
}
