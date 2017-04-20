<?php
namespace Example\Infrastructure\Controller;

use Example\Reader\VinLookupRequestReader;
use Example\Writer\VehicleWriter;

final class VinLookupRequestController
{
    /**
     * @var VehicleRepository
     */
    private $repository;

    /**
     * @var VinLookupRequestReader
     */
    private $reader;

    /**
     * @var VehicleWriter
     */
    private $writer;

    public function __construct(
        VehicleRepository $repository,
        VinLookupRequestReader $reader,
        VehicleWriter $writer
    ) {
        $this->repository = $repository;
        $this->reader = $reader;
        $this->writer = $writer;
    }

    public function handle(Request $request, Response $response)
    {
        $vins = $this->reader->read($request->getBody());
        $vehicles = $this->repository->findByVins($vins);
        $response->setBody($this->writer->write($vehicles));
    }

}
