<?php

namespace Core\Domain\Supplier;

interface RepositoryInterface
{
    public function getSpecificByName(string $name): ?Supplier;
}
