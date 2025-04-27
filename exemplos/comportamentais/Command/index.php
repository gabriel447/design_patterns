<?php

// Interface base de Comando
abstract class Comando
{
    abstract public function executar(): void;
}

// Receptor: a Cozinha que sabe preparar pedidos
class Cozinha
{
    public function prepararPizza(): void
    {
        echo "🍕 Preparando uma deliciosa pizza...\n";
    }

    public function prepararHamburguer(): void
    {
        echo "🍔 Preparando um suculento hambúrguer...\n";
    }

    public function prepararSalada(): void
    {
        echo "🥗 Preparando uma salada fresca...\n";
    }
}

// Comandos concretos
class ComandoPizza extends Comando
{
    private Cozinha $cozinha;

    public function __construct(Cozinha $cozinha)
    {
        $this->cozinha = $cozinha;
    }

    public function executar(): void
    {
        $this->cozinha->prepararPizza();
    }
}

class ComandoHamburguer extends Comando
{
    private Cozinha $cozinha;

    public function __construct(Cozinha $cozinha)
    {
        $this->cozinha = $cozinha;
    }

    public function executar(): void
    {
        $this->cozinha->prepararHamburguer();
    }
}

class ComandoSalada extends Comando
{
    private Cozinha $cozinha;

    public function __construct(Cozinha $cozinha)
    {
        $this->cozinha = $cozinha;
    }

    public function executar(): void
    {
        $this->cozinha->prepararSalada();
    }
}

// Invocador: o Garçom que recebe pedidos e executa
class Garcom
{
    private array $filaPedidos = [];

    public function receberPedido(Comando $pedido): void
    {
        $this->filaPedidos[] = $pedido;
    }

    public function servirPedidos(): void
    {
        foreach ($this->filaPedidos as $pedido) {
            $pedido->executar();
        }
        $this->filaPedidos = []; // Limpa após servir
    }
}

// ----------------------------
// EXEMPLO DE USO
// ----------------------------

echo "=== Restaurante Padrão Command ===\n";

$cozinha = new Cozinha();
$garcom = new Garcom();

// Cliente faz os pedidos
$garcom->receberPedido(new ComandoPizza($cozinha));
$garcom->receberPedido(new ComandoHamburguer($cozinha));
$garcom->receberPedido(new ComandoSalada($cozinha));

// Garçom serve os pedidos
echo "\n🔔 Garçom: Servindo os pedidos!\n";
$garcom->servirPedidos();