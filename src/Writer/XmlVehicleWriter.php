<?php
namespace Example\Writer;

final class XmlVehicleWriter implements VehicleWriter
{
    /**
     * @var \XMLWriter
     */
    private $xmlWriter;

    public function __construct(\XMLWriter $xmlWriter)
    {
        $this->xmlWriter = $xmlWriter;
    }

    /**
     * @param  \Example\Vehicle[] $vehicles
     * @return string
     */
    public function write(array $vehicles): string
    {
        $this->xmlWriter->startDocument('1.0', 'UTF-8');
        $this->xmlWriter->startElement('vehicles');
        foreach ($vehicles as $vehicle) {
            $this->xmlWriter->startElement('vehicle');
            $this->xmlWriter->writeElement('vin',               $vehicle->getVin());
            $this->xmlWriter->writeElement('price',             $vehicle->getPrice());
            $this->xmlWriter->writeElement('manufactured-date', $vehicle->getManufacturedDate());
            $this->xmlWriter->endElement();
        }
        $this->xmlWriter->endElement();
        $this->xmlWriter->endDocument();

        return $this->xmlWriter->outputMemory(true);
    }
}
