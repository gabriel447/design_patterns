<?php
// Abstract Factory Pattern Example: Furniture Manufacturing (Chair and Sofa) for different styles

// Product Interfaces
interface Chair {
    public function getStyle(): string;
}

interface Sofa {
    public function getStyle(): string;
}

// Concrete Products for Modern Style
class ModernChair implements Chair {
    public function getStyle(): string {
        return "Modern Chair";
    }
}

class ModernSofa implements Sofa {
    public function getStyle(): string {
        return "Modern Sofa";
    }
}

// Concrete Products for Victorian Style
class VictorianChair implements Chair {
    public function getStyle(): string {
        return "Victorian Chair";
    }
}

class VictorianSofa implements Sofa {
    public function getStyle(): string {
        return "Victorian Sofa";
    }
}

// Abstract Factory Interface
interface FurnitureFactory {
    public function createChair(): Chair;
    public function createSofa(): Sofa;
}

// Concrete Factories
class ModernFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair {
        return new ModernChair();
    }
    public function createSofa(): Sofa {
        return new ModernSofa();
    }
}

class VictorianFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair {
        return new VictorianChair();
    }
    public function createSofa(): Sofa {
        return new VictorianSofa();
    }
}

// Client code
function clientCode(FurnitureFactory $factory) {
    $chair = $factory->createChair();
    $sofa = $factory->createSofa();

    echo "Created a " . $chair->getStyle() . PHP_EOL;
    echo "Created a " . $sofa->getStyle() . PHP_EOL;
}

// Usage
echo "Using Modern Furniture Factory:" . PHP_EOL;
clientCode(new ModernFurnitureFactory());

echo PHP_EOL;

echo "Using Victorian Furniture Factory:" . PHP_EOL;
clientCode(new VictorianFurnitureFactory());
