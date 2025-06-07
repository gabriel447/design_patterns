<?php

// Interface Comando
interface Comando {
    public function executar();
}

// Comando para registrar o pedido
class PedidoComando implements Comando {
    private $pedido;

    public function __construct($pedido) {
        $this->pedido = $pedido;
    }

    public function executar() {
        echo "Pedido recebido: " . $this->pedido . PHP_EOL . PHP_EOL;
    }
}

// Comando para cozinhar o pedido
class CozinharComando implements Comando {
    private $pedido;

    public function __construct($pedido) {
        $this->pedido = $pedido;
    }

    public function executar() {
        echo "Cozinhando a refeição: " . $this->pedido . PHP_EOL . PHP_EOL;
    }
}

// Comando para servir o pedido
class ServirComando implements Comando {
    private $pedido;

    public function __construct($pedido) {
        $this->pedido = $pedido;
    }

    public function executar() {
        echo "Servindo a refeição: " . $this->pedido . PHP_EOL . PHP_EOL;
    }
}

// O garçom (Invocador) que recebe e executa os comandos
class Garcom {
    private $comandos = [];

    public function adicionarComando(Comando $comando) {
        $this->comandos[] = $comando;
    }

    public function executarComandos() {
        foreach ($this->comandos as $comando) {
            $comando->executar();
        }
    }
}

// Código principal
$pedido1 = "Hambúrguer com batatas fritas";
$pedido2 = "Salada Caesar";

// Criando os comandos
$pedidoComando1 = new PedidoComando($pedido1);
$pedidoComando2 = new PedidoComando($pedido2);

$cozinharComando1 = new CozinharComando($pedido1);
$cozinharComando2 = new CozinharComando($pedido2);

$servirComando1 = new ServirComando($pedido1);
$servirComando2 = new ServirComando($pedido2);

// Criando o garçom (invocador)
$garcom = new Garcom();

// Adicionando os comandos na sequência correta
$garcom->adicionarComando($pedidoComando1);
$garcom->adicionarComando($pedidoComando2);
$garcom->adicionarComando($cozinharComando1);
$garcom->adicionarComando($cozinharComando2);
$garcom->adicionarComando($servirComando1);
$garcom->adicionarComando($servirComando2);

// O garçom executa todos os comandos
$garcom->executarComandos();