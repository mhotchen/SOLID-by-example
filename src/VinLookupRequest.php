<?php
namespace Example;

final class VinLookupRequest
{
    /**
     * @var string
     */
    private $vin;

    public function __construct(string $vin)
    {
        $this->vin = $vin;
    }
}
