<?php

namespace Core\Domain\Integration\Query;

class GetIntegrationProductsQuery
{
    private string $source;
    private string $supplierName;
    private array $options;


    public function __construct(string $source, string $supplierName, array $options)
    {
        $this->source = $source;
        $this->supplierName = $supplierName;
        $this->options = $options;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getSupplierName(): string
    {
        return $this->supplierName;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
