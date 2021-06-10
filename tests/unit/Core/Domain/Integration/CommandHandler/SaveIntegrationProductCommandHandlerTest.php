<?php


namespace App\Tests\unit\Core\Domain\Integration\CommandHandler;


use Core\Domain\Integration\Command\SaveIntegrationProductCommand;
use Core\Domain\Integration\CommandHandler\SaveIntegrationProductCommandHandler;
use Core\Domain\Integration\IntegrationProductInterface;
use Core\Domain\Integration\PersisterInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\Test\TestLogger;

class SaveIntegrationProductCommandHandlerTest extends TestCase
{
    private PersisterInterface $persister;
    private LoggerInterface $logger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->persister = $this->getMockBuilder(PersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logger = new TestLogger();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->logger->reset();
    }


    public function testShouldProccessQueryInExpectedWay(): void
    {
        // Expect
        $this->persister->expects($this->once())
            ->method('saveIntegrationProduct');


        // Given
        $integrationProduct = $this->getMockBuilder(IntegrationProductInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $command = new SaveIntegrationProductCommand($integrationProduct);
        $handler = new SaveIntegrationProductCommandHandler($this->persister, $this->logger);

        // When
        $handler($command);

        // Then
        $this->assertTrue($this->logger->hasInfoRecords());
    }
}