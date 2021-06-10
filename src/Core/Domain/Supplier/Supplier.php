<?php

declare(strict_types=1);

namespace Core\Domain\Supplier;

class Supplier
{
    private string $id;
    private string $name;
    private string $integrationUrl;

    public function __construct(SupplierDTO $dto)
    {
        $this->update($dto);
        $this->validate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIntegrationUrl(): string
    {
        return $this->integrationUrl;
    }

    private function update(SupplierDTO $dto): void
    {
        if (null !== $dto->id) {
            $this->id = $dto->id;
        }

        if (null !== $dto->name) {
            $this->name = $dto->name;
        }

        if (null !== $dto->integrationUrl) {
            $this->integrationUrl = $dto->integrationUrl;
        }
    }

    private function validate(): void
    {
        if (empty($this->id)) {
            throw SupplierValidationException::noId();
        }
        if (empty($this->name)) {
            throw SupplierValidationException::noName();
        }
        if (empty($this->integrationUrl)) {
            throw SupplierValidationException::noIntegrationUrl();
        }
    }
}
