<?php

declare(strict_types=1);

namespace Core\Infrastructure\API\Integration;

use Core\Domain\Integration\IntegrationProductInterface;
use Sabre\Xml\Service as XmlService;

abstract class AbstractXmlConnector extends AbstractConnector
{
    protected XmlService $xmlService;

    public function __construct(string $source, array $options)
    {
        $this->xmlService = new XmlService();
        parent::__construct($source, $options);
    }

    /**
     * @return IntegrationProductInterface[]
     */
    protected function getIntegrationProductsData(): array
    {
        $xml = $this->getData();
        $this->xmlService->elementMap = $this->getXmlMap();

        return $this->xmlService->parse($xml);
    }
}
