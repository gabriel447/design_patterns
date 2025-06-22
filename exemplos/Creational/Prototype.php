<?php

// Interface Prototype com método clone
interface Prototype
{
    public function clone(): Prototype;
}

// Classe Spaceship que implementa o padrão Prototype
class Spaceship implements Prototype
{
    private $type;
    private $weapon;
    private $shield;

    public function __construct(string $type, string $weapon, string $shield)
    {
        $this->type = $type;
        $this->weapon = $weapon;
        $this->shield = $shield;
    }

    // Método clone para criar uma cópia do objeto
    public function clone(): Prototype
    {
        return clone $this;
    }

    // Métodos setters para modificar propriedades
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setWeapon(string $weapon): void
    {
        $this->weapon = $weapon;
    }

    public function setShield(string $shield): void
    {
        $this->shield = $shield;
    }

    public function getDetails(): void
    {
        echo "Spaceship type: {$this->type}, weapon: {$this->weapon}, shield: {$this->shield}" . PHP_EOL;
    }
}

// Exemplo de uso do padrão Prototype com naves espaciais
function clientCode()
{
    // Nave base
    $baseShip = new Spaceship("Fighter", "Laser Cannons", "Energy Shield");
    echo "Base spaceship details:\n";
    $baseShip->getDetails();

    // Clonando a nave base e modificando algumas propriedades
    $shipClone1 = $baseShip->clone();
    $shipClone1->setWeapon("Plasma Guns");
    echo "Cloned spaceship 1 details:\n";
    $shipClone1->getDetails();

    $shipClone2 = $baseShip->clone();
    $shipClone2->setType("Bomber");
    $shipClone2->setShield("Heavy Armor");
    echo "Cloned spaceship 2 details:\n";
    $shipClone2->getDetails();
}

clientCode();

?>
