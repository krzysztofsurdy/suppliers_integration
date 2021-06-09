<?php

declare(strict_types=1);

namespace Core\Domain\Integration;

abstract class AbstractIntegrationProduct implements IntegrationProductInterface
{
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription()
        ];
    }
}
