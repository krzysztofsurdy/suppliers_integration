<?php


namespace Core\Domain\Integration\IntegrationProduct\AwesomeSixEleven;

use Core\Domain\Integration\AbstractIntegrationProduct;
use Core\Shared\Json\JsonDeserializable;

class IntegrationProduct extends AbstractIntegrationProduct implements JsonDeserializable
{
    private string $id;
    private string $name;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return null;
    }

    public static function injectArray(array $data): self
    {
        $product = new self();

        foreach ($data as $key => $value) {
            $product->{$key} = $value;
        }

        return $product;
    }
}