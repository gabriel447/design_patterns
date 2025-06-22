<?php
// Exemplo simples do padrão Flyweight em PHP

// Interface Flyweight
interface Flyweight {
    public function operation(string $extrinsicState): void;
}

// ConcreteFlyweight que armazena estado intrínseco
class ConcreteFlyweight implements Flyweight {
    private $intrinsicState;

    public function __construct(string $intrinsicState) {
        $this->intrinsicState = $intrinsicState;
    }

    public function operation(string $extrinsicState): void {
        echo "ConcreteFlyweight: Operação com estado intrínseco = '{$this->intrinsicState}' e estado extrínseco = '{$extrinsicState}'\n";
    }
}

// FlyweightFactory que cria e gerencia os flyweights
class FlyweightFactory {
    private $flyweights = [];

    public function getFlyweight(string $key): Flyweight {
        if (!isset($this->flyweights[$key])) {
            echo "FlyweightFactory: Criando novo flyweight para a chave '{$key}'.\n";
            $this->flyweights[$key] = new ConcreteFlyweight($key);
        } else {
            echo "FlyweightFactory: Reutilizando flyweight existente para a chave '{$key}'.\n";
        }
        return $this->flyweights[$key];
    }

    public function getCount(): int {
        return count($this->flyweights);
    }
}

// Código cliente
$factory = new FlyweightFactory();

$flyweight1 = $factory->getFlyweight("A");
$flyweight1->operation("Primeiro uso");

$flyweight2 = $factory->getFlyweight("B");
$flyweight2->operation("Segundo uso");

$flyweight3 = $factory->getFlyweight("A");
$flyweight3->operation("Terceiro uso");

echo "Número total de flyweights criados: " . $factory->getCount() . "\n";

?>
