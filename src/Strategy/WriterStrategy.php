<?php
namespace Example\Strategy;

use Example\Writer\VehicleWriter;

interface WriterStrategy
{
    public function canUseStrategy(): bool;
    public function getWriter(): VehicleWriter;
}
