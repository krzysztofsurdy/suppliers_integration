<?php


namespace App\Tests\unit\Core\Infrastructure\InMemory\Integration;


use Core\Domain\Integration\IntegrationProductInterface;
use Core\Infrastructure\InMemory\Integration\Mapper;
use PHPUnit\Framework\TestCase;

class MapperTest extends TestCase
{
    public function testShouldReturnProperDomainObjectWhenMappingFromDomain(): void
    {
        // Given
        $domainObject = $this->getMockBuilder(IntegrationProductInterface::class)
            ->disableAutoload()
            ->onlyMethods(['getId', 'getName', 'getDescription', 'toArray'])
            ->getMock();
        $domainObject->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('1'));
        $domainObject->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('Test'));
        $domainObject->expects($this->any())
            ->method('getDescription')
            ->will($this->returnValue('Test description'));

        // When
        $infrastructureObject = Mapper::fromDomain($domainObject);

        // Then
        $this->assertSame($domainObject->getId(), $infrastructureObject->id);
        $this->assertSame($domainObject->getName(), $infrastructureObject->name);
        $this->assertSame($domainObject->getDescription(), $infrastructureObject->description);
    }
}