<?php
// Comando.php - Interface que define o contrato dos comandos
interface Comando {
    public function executar();
}

// PedidoComando.php - Comando que representa um pedido feito pelo cliente
class PedidoComando implements Comando {
    private $pedido;
    private $garcom;

    // Injetando o garçom para que o comando de pedido o registre
    public function __construct($pedido, Garcom $garcom) {
        $this->pedido = $pedido;
        $this->garcom = $garcom;
    }

    public function executar() {
        echo "Pedido recebido: " . $this->pedido . PHP_EOL;
        $this->garcom->adicionarPedido($this);  // Adicionando pedido à fila do garçom
    }

    public function getPedido() {
        return $this->pedido;
    }
}

// CozinharComando.php - Comando que representa o ato de cozinhar o pedido
class CozinharComando implements Comando {
    private $pedido;
    private $chef;

    // Injetando o chef para que o comando de cozinhar o execute
    public function __construct($pedido, Chef $chef) {
        $this->pedido = $pedido;
        $this->chef = $chef;
    }

    public function executar() {
        $this->chef->cozinhar($this->pedido);  // Chef cozinha o pedido
    }
}

// ServirComando.php - Comando que representa o ato de servir a refeição
class ServirComando implements Comando {
    private $pedido;
    private $garcom;

    // Injetando o garçom para servir a refeição
    public function __construct($pedido, Garcom $garcom) {
        $this->pedido = $pedido;
        $this->garcom = $garcom;
    }

    public function executar() {
        $this->garcom->servir($this->pedido);  // Garçom serve a refeição
    }
}

// Chef.php - Receptor que cozinha a refeição
class Chef {
    public function cozinhar($pedido) {
        echo "Cozinhando a refeição: " . $pedido . PHP_EOL;
    }
}

// Garcom.php - Receptor que serve a refeição
class Garcom {
    private $filaDePedidos = [];

    public function adicionarPedido(PedidoComando $pedido) {
        $this->filaDePedidos[] = $pedido;
    }

    public function servir($pedido) {
        echo "O garçom está servindo a refeição: " . $pedido . PHP_EOL;
    }

    public function executarPedidos() {
        foreach ($this->filaDePedidos as $pedido) {
            echo "Processando o pedido: " . $pedido->getPedido() . PHP_EOL;
        }
    }
}

// Código principal (index.php)
$garcom = new Garcom();  // Criando o garçom (invocador)
$chef = new Chef();  // Criando o chef (receptor)

// Criando e executando os comandos
$pedido1 = new PedidoComando("Hambúrguer com batatas fritas", $garcom);
$pedido2 = new PedidoComando("Salada Caesar", $garcom);

$cozinharPedido1 = new CozinharComando($pedido1->getPedido(), $chef);
$cozinharPedido2 = new CozinharComando($pedido2->getPedido(), $chef);

$servirPedido1 = new ServirComando($pedido1->getPedido(), $garcom);
$servirPedido2 = new ServirComando($pedido2->getPedido(), $garcom);

// Adicionando os pedidos
$pedido1->executar();  // Pedido 1
$pedido2->executar();  // Pedido 2

// Executando os comandos de cozinhar e servir
$cozinharPedido1->executar();
$cozinharPedido2->executar();
$servirPedido1->executar();
$servirPedido2->executar();

$garcom->executarPedidos();  // Mostra o processo final dos pedidos