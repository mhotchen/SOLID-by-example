<?php
namespace Example\Type;

final class IsXml implements IsType
{
    public function isType(string $payload): bool
    {
        return $payload[0] === '<';
    }
}
