<?php
namespace Example\Writer;

use Example\Vehicle;

final class JsonVehicleWriter implements VehicleWriter
{
    /**
     * @param  \Example\Vehicle[] $vehicles
     * @return string
     */
    public function write(array $vehicles): string
    {
        return json_encode(array_map(
            function (Vehicle $vehicle) {
                return [
                    'vin'               => $vehicle->getVin(),
                    'price'             => $vehicle->getPrice(),
                    'manufactured_date' => $vehicle->getManufacturedDate()
                ];
            },
            $vehicles
        ));
    }
}
