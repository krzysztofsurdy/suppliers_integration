<?php

namespace Core\Infrastructure\API\Integration;

class ConnectorException extends \Exception
{
    public static function unsupportedSupplier(string $name): self
    {
        return new self(sprintf('Supplier integration %s is not supported.', $name));
    }
}
