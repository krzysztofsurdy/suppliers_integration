<?php

declare(strict_types=1);

namespace Core\Infrastructure\InMemory\Supplier;

use Core\Domain\Supplier\RepositoryInterface as DomainRepository;
use Core\Domain\Supplier\Supplier as DomainSupplier;
use Core\Shared\Dictionary\SupplierNameEnum;
use Ramsey\Uuid\Uuid;

class Repository implements DomainRepository
{
    /** @var Supplier[] */
    private array $memory = [];

    public function __construct()
    {
        // These are mocks to get rid of persistence service for the task needs
        // Normally they would be gathered from Doctrine or API etc. by its dedicated infrastructure port
        $firstSupplier = new Supplier();
        $firstSupplier->id = Uuid::uuid4()->toString();
        $firstSupplier->name = SupplierNameEnum::XYZLOGISTICS()->getValue();
        $firstSupplier->integrationUrl = getenv('DEFAULT_SUPPLIER_SERVER') . 'suppliers/supplier1.xml';
        $this->memory[] = $firstSupplier;

        $secondSupplier = new Supplier();
        $secondSupplier->id = Uuid::uuid4()->toString();
        $secondSupplier->name = SupplierNameEnum::SUPERDISTRIBUTION()->getValue();
        $secondSupplier->integrationUrl = getenv('DEFAULT_SUPPLIER_SERVER') . 'suppliers/supplier2.xml';
        $this->memory[] = $secondSupplier;

        $thirdSupplier = new Supplier();
        $thirdSupplier->id = Uuid::uuid4()->toString();
        $thirdSupplier->name = SupplierNameEnum::AWESOMESIXELEVEN()->getValue();
        $thirdSupplier->integrationUrl = getenv('DEFAULT_SUPPLIER_SERVER') . 'suppliers/supplier3.json';
        $this->memory[] = $thirdSupplier;
    }


    public function getSpecificByName(string $name): ?DomainSupplier
    {
        foreach ($this->memory as $supplier) {
            if ($supplier->name === $name) {
                return Mapper::mapToDomain($supplier);
            }
        }

        return null;
    }
}
