<?php

// A interface Strategy declara a operação comum
interface Strategy
{
    public function execute(int $a, int $b): int;
}

// Estratégia concreta de adição
class ConcreteStrategyAdd implements Strategy
{
    public function execute(int $a, int $b): int
    {
        return $a + $b;
    }
}

// Estratégia concreta de subtração
class ConcreteStrategySubtract implements Strategy
{
    public function execute(int $a, int $b): int
    {
        return $a - $b;
    }
}

// Estratégia concreta de multiplicação
class ConcreteStrategyMultiply implements Strategy
{
    public function execute(int $a, int $b): int
    {
        return $a * $b;
    }
}

// O Contexto mantém a estratégia atual
class Context
{
    private Strategy $strategy;

    public function setStrategy(Strategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $a, int $b): int
    {
        return $this->strategy->execute($a, $b);
    }
}

// Código cliente
class ExampleApplication
{
    public function main(): void
    {
        $context = new Context();

        // Lê o primeiro número
        echo "Digite o primeiro número: ";
        $firstNumber = (int) trim(fgets(STDIN));

        // Lê o segundo número
        echo "Digite o segundo número: ";
        $secondNumber = (int) trim(fgets(STDIN));

        // Lê o símbolo da operação desejada
        echo "Digite a operação desejada (+, -, *): ";
        $action = trim(fgets(STDIN));

        // Define a estratégia conforme o símbolo
        if ($action === '+') {
            $context->setStrategy(new ConcreteStrategyAdd());
        } elseif ($action === '-') {
            $context->setStrategy(new ConcreteStrategySubtract());
        } elseif ($action === '*') {
            $context->setStrategy(new ConcreteStrategyMultiply());
        } else {
            echo "Operação inválida.\n";
            exit(1);
        }

        // Executa a estratégia escolhida
        $result = $context->executeStrategy($firstNumber, $secondNumber);

        // Imprime o resultado
        echo "Resultado: $result\n";
    }
}

// Execução do aplicativo
$app = new ExampleApplication();
$app->main();