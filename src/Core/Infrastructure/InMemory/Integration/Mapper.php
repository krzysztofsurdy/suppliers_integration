<?php

declare(strict_types=1);

namespace Core\Infrastructure\InMemory\Integration;

use Core\Domain\Integration\IntegrationProductInterface as DomainIntegrationProduct;

class Mapper
{
    public static function fromDomain(DomainIntegrationProduct $entity): IntegrationProduct
    {
        $infrastractureEntity = new IntegrationProduct();
        $infrastractureEntity->id = $entity->getId();
        $infrastractureEntity->name = $entity->getName();
        $infrastractureEntity->description = $entity->getDescription();

        return $infrastractureEntity;
    }
}
