<?php
namespace Example\Writer;

interface VehicleWriter
{
    /**
     * @param  \Example\Vehicle[] $vehicles
     * @return string
     */
    public function write(array $vehicles): string;
}
