<?php


namespace App\Tests\unit\Core\Infrastructure\InMemory\Supplier;


use Core\Infrastructure\InMemory\Supplier\Mapper;
use Core\Infrastructure\InMemory\Supplier\Supplier;
use PHPUnit\Framework\TestCase;

class MapperTest extends TestCase
{
    public function testShouldReturnProperDomainObjectWhenMappingToDomain(): void
    {
        // Given
        $infrastructureObject = new Supplier();
        $infrastructureObject->id = '1';
        $infrastructureObject->name = 'Test';
        $infrastructureObject->integrationUrl = 'http://localhost/totally_legit_url';

        // When
        $domainObject = Mapper::mapToDomain($infrastructureObject);

        // Then
        $this->assertSame($infrastructureObject->id, $domainObject->getId());
        $this->assertSame($infrastructureObject->name, $domainObject->getName());
        $this->assertSame($infrastructureObject->integrationUrl, $domainObject->getIntegrationUrl());
    }
}