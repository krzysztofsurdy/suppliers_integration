<?php


namespace unit\Core\Domain\Supplier\QueryHandler;


use Core\Domain\Supplier\Query\GetSupplierByNameQuery;
use Core\Domain\Supplier\QueryHandler\GetSupplierByNameQueryHandler;
use Core\Domain\Supplier\RepositoryInterface;
use PHPUnit\Framework\TestCase;

class GetSupplierByNameQueryHandlerTest extends TestCase
{
    private RepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getMockBuilder(RepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testShouldProccessQueryInExpectedWay(): void
    {
        // Expect
        $this->repository->expects($this->once())
            ->method('getSpecificByName')
            ->willReturn(null);

        // Given
        $query = new GetSupplierByNameQuery('test');
        $handler = new GetSupplierByNameQueryHandler($this->repository);

        // When
        $handler($query);
    }
}