<?php
// Exemplo simples do padrão Proxy em PHP simulando uso de cache

// Interface Subject
interface Subject {
    public function request(): string;
}

// RealSubject que realiza a operação real (ex: busca de dados)
class RealSubject implements Subject {
    public function request(): string {
        // Simula uma operação custosa, como buscar dados de um banco ou API
        return "Dados buscados do RealSubject";
    }
}

// Proxy que controla o acesso ao RealSubject e implementa cache
class Proxy implements Subject {
    private $realSubject;
    private $cache;

    public function __construct(RealSubject $realSubject) {
        $this->realSubject = $realSubject;
        $this->cache = null;
    }

    public function request(): string {
        if ($this->cache === null) {
            echo "Cache vazio. Buscando dados do RealSubject...\n";
            $this->cache = $this->realSubject->request();
        } else {
            echo "Retornando dados do cache...\n";
        }
        return $this->cache;
    }
}

// Código cliente
function clientCode(Subject $subject) {
    echo $subject->request() . "\n";
    echo $subject->request() . "\n";
}

echo "Executando com RealSubject diretamente:\n";
$realSubject = new RealSubject();
clientCode($realSubject);

echo "\nExecutando com Proxy (com cache):\n";
$proxy = new Proxy($realSubject);
clientCode($proxy);

?>
