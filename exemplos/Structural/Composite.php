<?php

// Interface para o manipulador de chamadas
interface CallHandler {
    // Retorna true se a chamada foi tratada, false caso contrário
    public function handleCall(string $call): bool;
}

// Classe folha: Departamento de Vendas
class SalesDepartment implements CallHandler {
    public function handleCall(string $call): bool {
        if (stripos($call, 'venda') !== false) {
            echo "Ligação direcionada para o Departamento de Vendas: \"$call\"\n";
            return true;
        }
        return false;
    }
}

// Classe folha: Departamento de Suporte
class SupportDepartment implements CallHandler {
    public function handleCall(string $call): bool {
        if (stripos($call, 'suporte') !== false) {
            echo "Ligação direcionada para o Departamento de Suporte: \"$call\"\n";
            return true;
        }
        return false;
    }
}

// Classe folha: Departamento Financeiro
class FinanceDepartment implements CallHandler {
    public function handleCall(string $call): bool {
        if (stripos($call, 'financeiro') !== false) {
            echo "Ligação direcionada para o Departamento Financeiro: \"$call\"\n";
            return true;
        }
        return false;
    }
}

// Classe Composite: Central de Atendimento
class CallCenter implements CallHandler {
    /**
     * @var CallHandler[]
     */
    private array $handlers = [];

    public function addHandler(CallHandler $handler): void {
        $this->handlers[] = $handler;
    }

    public function handleCall(string $call): bool {
        $handled = false;
        foreach ($this->handlers as $handler) {
            // Cada handler tenta tratar a chamada
            // Para saber se foi tratado, vamos modificar os handlers para retornar boolean
            if ($handler->handleCall($call)) {
                $handled = true;
            }
        }
        if (!$handled) {
            echo "Nenhum departamento disponível para a ligação: \"$call\"\n";
        }
        return $handled;
    }
}

// Código cliente
$callCenter = new CallCenter();
$callCenter->addHandler(new SalesDepartment());
$callCenter->addHandler(new SupportDepartment());
$callCenter->addHandler(new FinanceDepartment());

// Simulação de chamadas
$calls = [
    "Preciso falar sobre uma venda",
    "Preciso de suporte",
    "Preciso falar com o financeiro",
    "Tenho um babado novo pra contar"
];

foreach ($calls as $call) {
    echo "\n";
    $callCenter->handleCall($call);
    echo "\n";
}

?>
