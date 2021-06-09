<?php

declare(strict_types=1);

namespace Core\Domain\Supplier;

interface RepositoryInterface
{
    public function getSpecificByName(string $name): ?Supplier;
}
