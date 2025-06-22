<?php

// Classe DatabaseConnection que implementa o padrão Singleton para conexão com banco de dados
class DatabaseConnection
{
    private static $instance = null;
    private $connection;

    // Construtor privado para evitar instanciação externa
    private function __construct()
    {
        // Simulação de conexão com banco de dados
        $this->connection = "Database connection established";
    }

    // Método estático para obter a única instância da classe
    public static function getInstance(): DatabaseConnection
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    // Método para obter a conexão (simulada)
    public function getConnection()
    {
        return $this->connection;
    }

    // Impede a clonagem da instância
    private function __clone()
    {
    }

    // Impede a desserialização da instância
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}

// Exemplo de uso do DatabaseConnection Singleton
function clientCode()
{
    $db1 = DatabaseConnection::getInstance();
    echo $db1->getConnection() . PHP_EOL;

    $db2 = DatabaseConnection::getInstance();

    // Ambos $db1 e $db2 são a mesma instância
    if ($db1 === $db2) {
        echo "Both database instances are the same." . PHP_EOL;
    }
}

clientCode();

?>
