<?php

declare(strict_types=1);

namespace Core\Domain\Supplier;

class SupplierValidationException extends \Exception
{
    private const NO_FIELD_EXCEPTION_FORMAT = 'No %s value given while creating Supplier.';

    public static function noId(): self
    {
        return new self(self::NO_FIELD_EXCEPTION_FORMAT, 'id');
    }

    public static function noName(): self
    {
        return new self(self::NO_FIELD_EXCEPTION_FORMAT, 'name');
    }

    public static function noIntegrationType(): self
    {
        return new self(self::NO_FIELD_EXCEPTION_FORMAT, 'integrationType');
    }

    public static function noIntegrationUrl(): self
    {
        return new self(self::NO_FIELD_EXCEPTION_FORMAT, 'integrationUrl');
    }
}
