<?php


namespace App\Tests\unit\Core\Infrastructure\API\Integration;


use Core\Domain\Integration\Integration;
use Core\Domain\Integration\IntegrationDTO;
use Core\Infrastructure\API\Integration\Connector\AwesomeSixElevenConnector;
use Core\Infrastructure\API\Integration\Connector\SuperDistributionConnector;
use Core\Infrastructure\API\Integration\Connector\XYZLogisticsConnector;
use Core\Infrastructure\API\Integration\ConnectorConfigurationDictionary;
use Core\Infrastructure\API\Integration\ConnectorException;
use Core\Infrastructure\API\Integration\ConnectorFactory;
use PHPUnit\Framework\TestCase;

class ConnectorFactoryTest extends TestCase
{
    /**
     * @dataProvider integrationDtoProvider
     */
    public function testShouldReturnProperConnectorForGivenSupplier
    (
        ConnectorConfigurationDictionary $inputSupplierEnum,
        string $expectedOutputConnectorClass
    ): void
    {
        // Given
        $dto = new IntegrationDTO();
        $dto->source = 'IT_DOES_NOT_MATTER';
        $dto->supplierName = $inputSupplierEnum->getValue();
        $dto->options = [];
        $integration = new Integration($dto);

        // When
        $connector = ConnectorFactory::getConnector($integration);

        // Then
        $this->assertInstanceOf($expectedOutputConnectorClass, $connector);
    }

    public function testShouldThrowExceptionWhenUnsupportedIntegrationGiven(): void
    {

        // Expect
        $this->expectException(ConnectorException::class);

        // Given
        $dto = new IntegrationDTO();
        $dto->source = 'IT_DOES_NOT_MATTER';
        $dto->supplierName = 'IM_UNSUPPORTED';
        $dto->options = [];
        $integration = new Integration($dto);

        // When
        $connector = ConnectorFactory::getConnector($integration);
    }

    public function integrationDtoProvider(): array
    {
        return [
            [
                'inputSupplier' => ConnectorConfigurationDictionary::XYZLOGISTICS(),
                'outputConnectorClass' => XYZLogisticsConnector::class
            ],
            [
                'inputSupplier' => ConnectorConfigurationDictionary::SUPERDISTRIBUTION(),
                'outputConnectorClass' => SuperDistributionConnector::class
            ],
            [
                'inputSupplier' => ConnectorConfigurationDictionary::AWESOMESIXELEVEN(),
                'outputConnectorClass' => AwesomeSixElevenConnector::class
            ]
        ];
    }
}