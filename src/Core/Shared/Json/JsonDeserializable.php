<?php


namespace Core\Shared\Json;

interface JsonDeserializable
{
    public static function injectArray(array $data): self;
}