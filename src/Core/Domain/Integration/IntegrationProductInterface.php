<?php

namespace Core\Domain\Integration;

interface IntegrationProductInterface
{
    public function getId(): string;
    public function getName(): string;
    public function getDescription(): ?string;
    public function toArray(): array;
}
