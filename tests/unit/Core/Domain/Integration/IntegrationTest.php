<?php


namespace App\Tests\unit\Core\Domain\Integration;


use Core\Domain\Integration\Integration;
use Core\Domain\Integration\IntegrationDTO;
use Core\Domain\Integration\IntegrationValidationException;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    public function testShouldBeCreatedProperlyWithValidData(): void
    {
        // Given
        $dto = new IntegrationDTO();
        $dto->source = 'http://amazon.com/super_awesome_feed.xml';
        $dto->supplierName = 'SupplierTest';
        $dto->options = ['LEGIT_HEADER' => true];

        // When
        $domainObject = new Integration($dto);

        // Then
        $this->assertInstanceOf(Integration::class, $domainObject);
        $this->assertSame($dto->source, $domainObject->getSource());
        $this->assertSame($dto->supplierName, $domainObject->getSupplierName());
        $this->assertSame($dto->options, $domainObject->getOptions());
    }

    public function testShouldThrowExceptionWhenCreatedWithInvalidSource(): void
    {
        // Expect
        $this->expectException(IntegrationValidationException::class);

        // Given
        $dto = new IntegrationDTO();
        $dto->supplierName = 'SupplierTest';
        $dto->options = ['LEGIT_HEADER' => true];

        // When
        new Integration($dto);
    }

    public function testShouldThrowExceptionWhenCreatedWithInvalidSupplierName(): void
    {
        // Expect
        $this->expectException(IntegrationValidationException::class);

        // Given
        $dto = new IntegrationDTO();
        $dto->source = 'http://amazon.com/super_awesome_feed.xml';
        $dto->options = ['LEGIT_HEADER' => true];

        // When
        new Integration($dto);
    }
}