<?php

declare(strict_types=1);

namespace Core\Domain\Supplier\Query;

class GetSupplierByNameQuery
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
