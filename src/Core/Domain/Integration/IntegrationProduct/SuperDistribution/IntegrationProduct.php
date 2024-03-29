<?php

declare(strict_types=1);

namespace Core\Domain\Integration\IntegrationProduct\SuperDistribution;

use Core\Domain\Integration\AbstractIntegrationProduct;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

class IntegrationProduct extends AbstractIntegrationProduct implements XmlDeserializable
{
    private string $key;
    private string $title;
    private string $description;

    public function getId(): string
    {
        return $this->key;
    }

    public function getName(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public static function xmlDeserialize(Reader $reader)
    {
        $product = new self();

        $xmlNodes = $reader->parseInnerTree();

        foreach ($xmlNodes as $xmlNode) {
            $product = self::parseNode($product, $xmlNode);
        }

        return $product;
    }

    private static function parseNode(self $product, array $xmlNode): self
    {
        $xmlNodeName = self::parseNodeName($xmlNode['name']);
        $xmlNodeValue = $xmlNode['value'];

        $product->$xmlNodeName = $xmlNodeValue;

        return $product;
    }

    private static function parseNodeName(string $name): string
    {
        return str_replace('{}', '', $name);
    }
}
