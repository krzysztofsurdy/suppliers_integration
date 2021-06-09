<?php

declare(strict_types=1);

namespace Core\Domain\Integration;

class IntegrationProductCollection
{
    /** @var IntegrationProductInterface[] */
    private array $integrationProducts = [];

    public function __construct(IntegrationProductInterface ...$integrationProducts)
    {
        foreach ($integrationProducts as $integrationProduct) {
            $this->add($integrationProduct);
        }
    }

    public function add(IntegrationProductInterface $integrationProduct): void
    {
        $this->integrationProducts[$integrationProduct->getId()] = $integrationProduct;
    }

    /** @return IntegrationProductInterface[] */
    public function getAll(): array
    {
        return $this->integrationProducts;
    }

    public function toArray(): array
    {
        return array_map(
            function (IntegrationProductInterface $integrationProduct) {
                return $integrationProduct->toArray();
            },
            $this->integrationProducts
        );
    }
}
