<?php
namespace Example\Reader;

use Example\VinLookupRequest;

final class JsonVinLookupRequestReader implements VinLookupRequestReader
{
    public function read(string $payload): array
    {
        return array_map(
            function ($vehicleLookupRequest) {
                return new VinLookupRequest($vehicleLookupRequest->vin);
            },
            json_decode($payload)
        );
    }
}
