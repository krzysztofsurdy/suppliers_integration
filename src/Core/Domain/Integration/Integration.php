<?php

declare(strict_types=1);

namespace Core\Domain\Integration;

class Integration
{
    private string $source;
    private string $supplierName;
    private array $options;

    public function __construct(IntegrationDTO $dto)
    {
        $this->update($dto);
        $this->validate();
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

    private function update(IntegrationDTO $dto): void
    {
        if (null !== $dto->source) {
            $this->source = $dto->source;
        }

        if (null !== $dto->supplierName) {
            $this->supplierName = $dto->supplierName;
        }

        if (null !== $dto->options) {
            $this->options = $dto->options;
        }
    }

    private function validate(): void
    {
        if (empty($this->source)) {
            throw IntegrationValidationException::noSource();
        }
        if (empty($this->supplierName)) {
            throw IntegrationValidationException::noSupplierName();
        }
    }
}
