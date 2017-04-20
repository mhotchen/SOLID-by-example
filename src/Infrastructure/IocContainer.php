<?php
namespace Example\Infrastructure;

use Example\Infrastructure\Controller\VinLookupRequestController;
use Example\Reader\JsonVinLookupRequestReader;
use Example\Reader\XmlVinLookupRequestReader;
use Example\Strategy\ReaderStrategy;
use Example\Strategy\Strategy;
use Example\Strategy\WriterStrategy;
use Example\Type\IsJson;
use Example\Type\IsXml;
use Example\Writer\JsonVehicleWriter;
use Example\Writer\XmlVehicleWriter;
use XMLReader;
use XMLWriter;

final class IocContainer
{
    public function getJsonVinLookupRequestReader(): JsonVinLookupRequestReader
    {
        return new JsonVinLookupRequestReader();
    }

    public function getXmlVinLookupRequestReader(): XmlVinLookupRequestReader
    {
        return new XmlVinLookupRequestReader(new XMLReader());
    }

    public function getJsonVehicleWriter(): JsonVehicleWriter
    {
        return new JsonVehicleWriter();
    }

    public function getXmlVehicleWriter(): XmlVehicleWriter
    {
        return new XmlVehicleWriter(new XMLWriter());
    }

    public function getVinLookupRequestReaderStrategy(string $payload): ReaderStrategy
    {
        return $this->getStrategy($payload);
    }

    public function getVehicleWriterStrategy(string $payload): WriterStrategy
    {
        return $this->getStrategy($payload);
    }

    public function getController(Request $request): VinLookupRequestController
    {
        $payload = $request->getBody();

        // Skipping doing any URL parsing etc. since there's only one controller

        return new VinLookupRequestController(
            $this->getRepository(),
            $this
                ->getVinLookupRequestReaderStrategy($payload)
                ->getReader(),
            $this
                ->getVehicleWriterStrategy($payload)
                ->getWriter()
        );
    }

    private function getStrategy(string $payload): Strategy
    {
        foreach ($this->getStrategies($payload) as $strategy) {
            if ($strategy->canUseStrategy()) {
                return $strategy;
            }
        }

        // Error handling/validation would be done based on this
        throw new \Exception("Request payload is in unknown format");
    }

    private function getStrategies(string $payload): array
    {
        return [
            new Strategy(
                new IsJson(),
                $payload,
                $this->getJsonVinLookupRequestReader(),
                $this->getJsonVehicleWriter()
            ),
            new Strategy(
                new IsXml(),
                $payload,
                $this->getXmlVinLookupRequestReader(),
                $this->getXmlVehicleWriter()
            ),
        ];
    }
}
