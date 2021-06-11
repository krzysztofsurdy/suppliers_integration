<?php

declare(strict_types=1);

namespace Core\Domain\Integration;

class IntegrationDTO
{
    public ?string $source = null;
    public ?string $supplierName = null;
    public ?array $options = null;
}
