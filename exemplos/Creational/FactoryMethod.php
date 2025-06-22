<?php

// Interface Product: Transport
interface Transport
{
    public function deliver(): string;
}

// Concrete Product: Truck
class Truck implements Transport
{
    public function deliver(): string
    {
        return "Delivering by land in a truck.";
    }
}

// Concrete Product: Ship
class Ship implements Transport
{
    public function deliver(): string
    {
        return "Delivering by sea in a ship.";
    }
}

// Abstract Creator: Logistics
abstract class Logistics
{
    // Factory Method
    abstract public function createTransport(): Transport;

    // Some operation that uses the product
    public function planDelivery(): string
    {
        $transport = $this->createTransport();
        return "Logistics: " . $transport->deliver();
    }
}

// Concrete Creator: Road Logistics
class RoadLogistics extends Logistics
{
    public function createTransport(): Transport
    {
        return new Truck();
    }
}

// Concrete Creator: Sea Logistics
class SeaLogistics extends Logistics
{
    public function createTransport(): Transport
    {
        return new Ship();
    }
}

// Código cliente
function clientCode(Logistics $logistics)
{
    echo $logistics->planDelivery() . "\n";
}

// Uso do código
echo "App: Delivery with Road Logistics:\n";
clientCode(new RoadLogistics());

echo "\nApp: Delivery with Sea Logistics:\n";
clientCode(new SeaLogistics());

?>
