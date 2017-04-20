<?php
namespace Example;

final class Vehicle
{
    /**
     * @var string
     */
    private $vin;

    /**
     * @var string
     */
    private $price;

    /**
     * @var \DateTime
     */
    private $manufacturedDate;

    public function __construct(string $vin, string $price, \DateTime $manufacturedDate)
    {
        $this->vin = $vin;
        $this->price = $price;
        $this->manufacturedDate = $manufacturedDate;
    }

    /**
     * @return string
     */
    public function getVin(): string
    {
        return $this->vin;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @return \DateTime
     */
    public function getManufacturedDate(): \DateTime
    {
        return $this->manufacturedDate;
    }
}
