<?php

declare(strict_types=1);

namespace Core\Infrastructure\API\Integration;

use Core\Domain\Integration\IntegrationProductCollection;
use Core\Domain\Integration\IntegrationProductInterface;

abstract class AbstractConnector
{
    private string $source;
    private ?array $options;

    protected const MAX_CONNECTION_TIME = 600;

    public function __construct(string $source, ?array $options = null)
    {
        $this->source = $source;
        $this->options = $options;
    }

    protected function getData(): string
    {
        if (stream_is_local($this->source)) {
            return file_get_contents($this->source);
        }

        return $this->execute();
    }

    private function execute(): string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->source);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, self::MAX_CONNECTION_TIME);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, self::MAX_CONNECTION_TIME);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if ($this->options) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->options);
        }

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function getIntegrationProducts(): IntegrationProductCollection
    {
        $parsed = $this->getIntegrationProductsData();
        $collection = new IntegrationProductCollection();

        foreach ($parsed as $integrationProduct) {
            $collection->add($integrationProduct);
        }

        return $collection;
    }

    protected function getXmlMap(): array
    {
        return [];
    }

    /**
     * @return IntegrationProductInterface[]
     */
    protected function getIntegrationProductsData(): array
    {
        return [];
    }
}
