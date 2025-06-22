<?php

// Produto complexo: um computador com várias partes
class Computer
{
    private $parts = [];

    public function addPart(string $part)
    {
        $this->parts[] = $part;
    }

    public function listParts()
    {
        echo "Computer parts: " . implode(', ', $this->parts) . PHP_EOL;
    }
}

// Interface Builder define os passos para construir o computador
interface ComputerBuilder
{
    public function buildCPU();
    public function buildRAM();
    public function buildStorage();
    public function getComputer(): Computer;
}

// Implementação concreta do Builder para construir um computador gamer
class GamingComputerBuilder implements ComputerBuilder
{
    private $computer;

    public function __construct()
    {
        $this->computer = new Computer();
    }

    public function buildCPU()
    {
        $this->computer->addPart("High-end CPU");
    }

    public function buildRAM()
    {
        $this->computer->addPart("16GB RAM");
    }

    public function buildStorage()
    {
        $this->computer->addPart("1TB SSD");
    }

    public function getComputer(): Computer
    {
        return $this->computer;
    }
}

// Diretor que controla a construção do computador usando o Builder
class ComputerShop
{
    private $builder;

    public function __construct(ComputerBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function buildBasicComputer()
    {
        $this->builder->buildCPU();
        $this->builder->buildRAM();
    }

    public function buildFullFeaturedComputer()
    {
        $this->builder->buildCPU();
        $this->builder->buildRAM();
        $this->builder->buildStorage();
    }
}

// Exemplo de uso do padrão Builder com um computador gamer
function clientCode()
{
    $builder = new GamingComputerBuilder();
    $shop = new ComputerShop($builder);

    echo "Building basic computer:\n";
    $shop->buildBasicComputer();
    $computer = $builder->getComputer();
    $computer->listParts();

    echo "Building full featured computer:\n";
    $builder = new GamingComputerBuilder(); // reset builder
    $shop = new ComputerShop($builder);
    $shop->buildFullFeaturedComputer();
    $computer = $builder->getComputer();
    $computer->listParts();
}

clientCode();

?>
