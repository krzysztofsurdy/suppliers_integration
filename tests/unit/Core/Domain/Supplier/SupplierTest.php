<?php


namespace App\Tests\unit\Core\Domain\Supplier;


use Core\Domain\Supplier\Supplier;
use Core\Domain\Supplier\SupplierDTO;
use Core\Domain\Supplier\SupplierValidationException;
use PHPUnit\Framework\TestCase;

class SupplierTest extends TestCase
{
    public function testShouldBeCreatedProperlyWithValidData(): void
    {
        // Given
        $dto = new SupplierDTO();
        $dto->id = '1';
        $dto->name = 'TestSupplier';
        $dto->integrationUrl = 'http://google.com/totally_not_a_scam_link';

        // When
        $domainObject = new Supplier($dto);

        // Then
        $this->assertInstanceOf(Supplier::class, $domainObject);
        $this->assertSame($dto->id, $domainObject->getId());
        $this->assertSame($dto->name, $domainObject->getName());
        $this->assertSame($dto->integrationUrl, $domainObject->getIntegrationUrl());
    }

    public function testShouldThrowExceptionWhenCreatedWithInvalidId(): void
    {
        // Expect
        $this->expectException(SupplierValidationException::class);

        // Given
        $dto = new SupplierDTO();
        $dto->name = 'TestSupplier';
        $dto->integrationUrl = 'http://google.com/totally_not_a_scam_link';

        // When
        new Supplier($dto);
    }

    public function testShouldThrowExceptionWhenCreatedWithInvalidName(): void
    {
        // Expect
        $this->expectException(SupplierValidationException::class);

        // Given
        $dto = new SupplierDTO();
        $dto->id = '1';
        $dto->integrationUrl = 'http://google.com/totally_not_a_scam_link';

        // When
        new Supplier($dto);
    }

    public function testShouldThrowExceptionWhenCreatedWithInvalidIntegrationUrl(): void
    {
        // Expect
        $this->expectException(SupplierValidationException::class);

        // Given
        $dto = new SupplierDTO();
        $dto->id = '1';
        $dto->name = 'TestSupplier';

        // When
        new Supplier($dto);
    }
}