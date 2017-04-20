<?php
namespace Example\Type;

final class IsJson implements IsType
{
    public function isType(string $payload): bool
    {
        return in_array($payload[0], ['{', '[']);
    }
}
