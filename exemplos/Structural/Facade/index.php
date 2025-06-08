<?php
// Exemplo simples do padrão Facade em PHP

// Subsystem 1
class SubsystemA {
    public function operationA1() {
        return "SubsystemA: Operação A1\n";
    }

    public function operationA2() {
        return "SubsystemA: Operação A2\n";
    }
}

// Subsystem 2
class SubsystemB {
    public function operationB1() {
        return "SubsystemB: Operação B1\n";
    }

    public function operationB2() {
        return "SubsystemB: Operação B2\n";
    }
}

// Subsystem 3
class SubsystemC {
    public function operationC1() {
        return "SubsystemC: Operação C1\n";
    }
}

// Facade
class Facade {
    protected $subsystemA;
    protected $subsystemB;
    protected $subsystemC;

    public function __construct() {
        $this->subsystemA = new SubsystemA();
        $this->subsystemB = new SubsystemB();
        $this->subsystemC = new SubsystemC();
    }

    // Operação simplificada que usa vários subsistemas
    public function operation() {
        $result = "Facade inicializando operações:\n";
        $result .= $this->subsystemA->operationA1();
        $result .= $this->subsystemB->operationB1();
        $result .= $this->subsystemC->operationC1();
        $result .= "Facade finalizando operações.\n";
        return $result;
    }
}

// Código cliente
$facade = new Facade();
echo $facade->operation();

?>
