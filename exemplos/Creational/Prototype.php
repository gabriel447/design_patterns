<?php

// Interface Prototype com método clonePrototype
interface Prototype
{
    /**
     * Clona o protótipo
     * @return Prototype
     */
    public function clonePrototype(): Prototype;
}

/**
 * Classe Spaceship que implementa o padrão Prototype
 */
class Spaceship implements Prototype
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $weapon;

    /**
     * @var string
     */
    private $shield;

    /**
     * Construtor da classe Spaceship
     * @param string $type
     * @param string $weapon
     * @param string $shield
     */
    public function __construct(string $type, string $weapon, string $shield)
    {
        $this->type = $type;
        $this->weapon = $weapon;
        $this->shield = $shield;
    }

    /**
     * Método clonePrototype para criar uma cópia do objeto
     * @return Prototype
     */
    public function clonePrototype(): Prototype
    {
        return clone $this;
    }

    /**
     * Define o tipo da nave
     * @param string $type
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Define a arma da nave
     * @param string $weapon
     * @return void
     */
    public function setWeapon(string $weapon): void
    {
        $this->weapon = $weapon;
    }

    /**
     * Define o escudo da nave
     * @param string $shield
     * @return void
     */
    public function setShield(string $shield): void
    {
        $this->shield = $shield;
    }

    /**
     * Exibe os detalhes da nave
     * @return void
     */
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
    $shipClone1 = $baseShip->clonePrototype();
    $shipClone1->setWeapon("Plasma Guns");
    echo "Cloned spaceship 1 details:\n";
    $shipClone1->getDetails();

    $shipClone2 = $baseShip->clonePrototype();
    $shipClone2->setType("Bomber");
    $shipClone2->setShield("Heavy Armor");
    echo "Cloned spaceship 2 details:\n";
    $shipClone2->getDetails();
}

clientCode();

?>
