<?php

declare(strict_types=1);

namespace Application\Command;

use Application\Service\IntegrationService;
use Application\Service\SupplierService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SupplierSyncCommand extends Command
{
    protected static $defaultName = 'divante:supplier-sync';

    private SupplierService $supplierService;
    private IntegrationService $integrationService;

    public function __construct(SupplierService $supplierService, IntegrationService $integrationService)
    {
        $this->supplierService = $supplierService;
        $this->integrationService = $integrationService;
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->setDescription('Synchronises a given supplier')
            ->addArgument(
                'supplier',
                InputArgument::REQUIRED,
                'Which supplier do you want to synchronize?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $supplierName = $input->getArgument('supplier');
        $io->info('Synchronising supplier ' . $supplierName);

        try {
            $supplier = $this->supplierService->getSupplierByName($supplierName);
            $integrationProducts = $this->integrationService->getIntegrationProducts(
                $supplier->getIntegrationUrl(),
                $supplier->getName()
            );

            $table = new Table($output);
            $table->setHeaders(array('id', 'name', 'description'))->setRows($integrationProducts->toArray());
            $table->render();
        } catch (\InvalidArgumentException | InvalidParserException $exception) {
            $output->writeln('<error>' . $exception->getMessage() . '</error>');
        }

        $io->success('Done!');
        return Command::SUCCESS;
    }
}
