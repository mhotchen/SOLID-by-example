<?php
namespace Example\Strategy;

use Example\Reader\VinLookupRequestReader;
use Example\Type\IsType;
use Example\Writer\VehicleWriter;

final class Strategy implements ReaderStrategy, WriterStrategy
{
    private $payloadType;
    private $payload;
    private $reader;
    private $writer;

    public function __construct(
        IsType $payloadType,
        string $payload,
        VinLookupRequestReader $reader,
        VehicleWriter $writer
    ) {
        $this->payloadType = $payloadType;
        $this->payload = $payload;
        $this->reader = $reader;
        $this->writer = $writer;
    }

    public function canUseStrategy(): bool
    {
        return $this->payloadType->isType($this->payload);
    }

    public function getReader(): VinLookupRequestReader
    {
        return $this->reader;
    }

    public function getWriter(): VehicleWriter
    {
        return $this->writer;
    }
}
