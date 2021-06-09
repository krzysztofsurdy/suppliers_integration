<?php

declare(strict_types=1);

namespace Core\Shared\Json;

interface JsonDeserializable
{
    public static function injectArray(array $data): self;
}
