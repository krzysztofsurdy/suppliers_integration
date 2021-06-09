<?php

namespace Core\Infrastructure\API\Integration;

interface IntegrationProductInterface
{
    public function getId(): string;
    public function getName(): string;
    public function getDescription(): ?string;
}
