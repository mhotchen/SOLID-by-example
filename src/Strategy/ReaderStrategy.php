<?php
namespace Example\Strategy;

use Example\Reader\VinLookupRequestReader;

interface ReaderStrategy
{
    public function canUseStrategy(): bool;
    public function getReader(): VinLookupRequestReader;
}
