<?php

namespace Core\Infrastructure\InMemory\Supplier;

use Core\Domain\Supplier\Supplier as DomainSupplier;
use Core\Domain\Supplier\SupplierDTO;

class Mapper
{
    public static function mapToDomain(Supplier $entity): DomainSupplier
    {
        $dto = new SupplierDTO();
        $dto->id = $entity->id;
        $dto->name = $entity->name;
        $dto->integrationUrl = $entity->integrationUrl;

        return new DomainSupplier($dto);
    }
}
