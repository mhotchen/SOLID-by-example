<?php
namespace Example\Type;

interface IsType
{
    public function isType(string $payload): bool;
}
