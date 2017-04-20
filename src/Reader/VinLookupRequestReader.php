<?php
namespace Example\Reader;

interface VinLookupRequestReader
{
    /**
     * @param  string $payload
     * @return \Example\VinLookupRequest[]
     */
    public function read(string $payload): array;
}
