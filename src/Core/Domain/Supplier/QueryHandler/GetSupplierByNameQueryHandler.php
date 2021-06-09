<?php


namespace Core\Domain\Supplier\QueryHandler;


use Core\Domain\Supplier\Query\GetSupplierByNameQuery;
use Core\Domain\Supplier\RepositoryInterface;
use Core\Domain\Supplier\Supplier;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetSupplierByNameQueryHandler implements MessageHandlerInterface
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetSupplierByNameQuery $query): ?Supplier
    {
        return $this->repository->getSpecificByName($query->getName());
    }
}