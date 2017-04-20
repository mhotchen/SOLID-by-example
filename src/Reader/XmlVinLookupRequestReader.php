<?php
namespace Example\Reader;

use Example\VinLookupRequest;

final class XmlVinLookupRequestReader implements VinLookupRequestReader
{
    /**
     * @var \XMLReader
     */
    private $xmlReader;

    public function __construct(\XMLReader $xmlReader)
    {
        $this->xmlReader = $xmlReader;
    }

    public function read(string $payload): array
    {
        $response = [];
        $this->xmlReader->xml($payload);
        while ($this->xmlReader->read()) {
            if ($this->xmlReader->nodeType === \XMLReader::END_ELEMENT) {
                continue;
            }

            if ($this->xmlReader->name === 'vin') {
                $response[] = new VinLookupRequest($this->xmlReader->readString());
            }
        }

        return $response;
    }
}
