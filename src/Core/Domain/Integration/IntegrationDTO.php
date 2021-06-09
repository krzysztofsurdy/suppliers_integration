<?php

declare(strict_types=1);

namespace Core\Domain\Integration;

use Core\Shared\Dictionary\SupplierNameEnum;

class IntegrationDTO
{
    public ?string $source = null;
    public ?SupplierNameEnum $supplierName = null;
    public ?array $options = null;
}
