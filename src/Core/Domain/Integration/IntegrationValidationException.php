<?php

declare(strict_types=1);

namespace Core\Domain\Integration;

class IntegrationValidationException extends \Exception
{
    private const NO_FIELD_EXCEPTION_FORMAT = 'No %s value given while creating Integration.';

    public static function noSource(): self
    {
        return new self(sprintf(self::NO_FIELD_EXCEPTION_FORMAT, 'source'));
    }
    public static function noSupplierName(): self
    {
        return new self(sprintf(self::NO_FIELD_EXCEPTION_FORMAT, 'supplierName'));
    }
}
