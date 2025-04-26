<?php

// Classe abstrata que define o esqueleto do algoritmo.
abstract class GameAI
{
    protected array $builtStructures = [];
    protected array $units = [];
    protected int $resources = 100;

    // Método de template que define o esqueleto do turno
    public function turno(): void
    {
        $this->coletarRecursos();
        $this->construirEstruturas();
        $this->construirUnidades();
        $this->atacar();
    }

    // Método padrão para coletar recursos
    public function coletarRecursos(): void
    {
        echo "Coletando recursos...\n";
        $this->resources += 50;  // Aumenta os recursos ao coletar
    }

    // Métodos abstratos para construção de estruturas e unidades
    abstract protected function construirEstruturas(): void;
    abstract protected function construirUnidades(): void;

    // Método padrão para atacar
    public function atacar(): void
    {
        echo "Atacando!\n";
    }
}

// Classe concreta para os Humanos
class HumanAI extends GameAI
{
    protected function construirEstruturas(): void
    {
        echo "Humanos: Construindo castelos e fazendas.\n";
        // Lógica de construção de castelos e fazendas
        $this->builtStructures[] = "Castelo";
    }

    protected function construirUnidades(): void
    {
        echo "Humanos: Construindo cavaleiros e arqueiros.\n";
        // Lógica de construção de unidades
        $this->units[] = "Cavaleiro";
        $this->units[] = "Arqueiro";
    }
}

// Classe concreta para os Elfos
class ElfAI extends GameAI
{
    protected function construirEstruturas(): void
    {
        echo "Elfos: Construindo templos e árvores sagradas.\n";
        // Lógica de construção de templos e árvores
        $this->builtStructures[] = "Templo";
    }

    protected function construirUnidades(): void
    {
        echo "Elfos: Construindo arqueiros e druidas.\n";
        // Lógica de construção de unidades
        $this->units[] = "Arqueiro";
        $this->units[] = "Druida";
    }
}

// Classe concreta para os Mortos-Vivos
class UndeadAI extends GameAI
{
    protected function construirEstruturas(): void
    {
        echo "Mortos-Vivos: Construindo cemitérios e necrópolis.\n";
        // Lógica de construção de cemitérios e necrópolis
        $this->builtStructures[] = "Cemitério";
    }

    protected function construirUnidades(): void
    {
        echo "Mortos-Vivos: Construindo esqueletos e liches.\n";
        // Lógica de construção de unidades
        $this->units[] = "Esqueleto";
        $this->units[] = "Lich";
    }
}

// Classe concreta para os Orcs
class OrcAI extends GameAI
{
    protected function construirEstruturas(): void
    {
        echo "Orcs: Construindo ferreiros e barracas.\n";
        // Lógica de construção de ferreiros e barracas
        $this->builtStructures[] = "Ferreiro";
        $this->builtStructures[] = "Barraca";
    }

    protected function construirUnidades(): void
    {
        echo "Orcs: Construindo guerreiros e brutos.\n";
        // Lógica de construção de unidades
        $this->units[] = "Guerreiro";
        $this->units[] = "Bruto";
    }
}

// Exemplo de uso:

// Humanos jogando
echo "Turno dos Humanos:\n";
$humanAI = new HumanAI();
$humanAI->turno();  // Chama o método turno(), que chama os outros métodos internamente

echo "\n";

// Elfos jogando
echo "Turno dos Elfos:\n";
$elfAI = new ElfAI();
$elfAI->turno();  // Chama o método turno(), que chama os outros métodos internamente

echo "\n";

// Mortos-Vivos jogando
echo "Turno dos Mortos-Vivos:\n";
$undeadAI = new UndeadAI();
$undeadAI->turno();  // Chama o método turno(), que chama os outros métodos internamente

echo "\n";

// Orcs jogando
echo "Turno dos Orcs:\n";
$orcAI = new OrcAI();
$orcAI->turno();  // Chama o método turno(), que chama os outros métodos internamente