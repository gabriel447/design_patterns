<?php

interface Strategy
{
    public function execute(int $a, int $b): int;
}

class ConcreteStrategyAdd implements Strategy
{
    public function execute(int $a, int $b): int
    {
        return $a + $b;
    }
}

class ConcreteStrategySubtract implements Strategy
{
    public function execute(int $a, int $b): int
    {
        return $a - $b;
    }
}

class ConcreteStrategyMultiply implements Strategy
{
    public function execute(int $a, int $b): int
    {
        return $a * $b;
    }
}

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

class ExampleApplication
{
    private Context $context;

    public function __construct()
    {
        $this->context = new Context();
    }

    public function main(): void
    {
        echo "Digite o primeiro número: ";
        $firstNumber = (int)trim(fgets(STDIN));

        echo "Digite o segundo número: ";
        $secondNumber = (int)trim(fgets(STDIN));

        echo "Digite a ação desejada (+, -, *): ";
        $action = trim(fgets(STDIN));

        switch ($action) {
            case '+':
                $this->context->setStrategy(new ConcreteStrategyAdd());
                break;
            case '-':
                $this->context->setStrategy(new ConcreteStrategySubtract());
                break;
            case '*':
                $this->context->setStrategy(new ConcreteStrategyMultiply());
                break;
            default:
                echo "Ação inválida.\n";
                exit(1);
        }

        $result = $this->context->executeStrategy($firstNumber, $secondNumber);

        echo "Resultado: $result\n";
    }
}

$app = new ExampleApplication();
$app->main();