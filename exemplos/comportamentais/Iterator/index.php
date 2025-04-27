<?php
// Classe que representa uma coleção de jogos da Nintendo
class NintendoGamesCollection implements Iterator
{
    private $games = [];
    private $position = 0;

    public function __construct(array $games)
    {
        $this->games = $games;
        $this->position = 0;
    }

    // Retorna o jogo atual
    public function current()
    {
        return $this->games[$this->position];
    }

    // Retorna a chave atual (índice ou posição do jogo)
    public function key()
    {
        return $this->position;
    }

    // Avança para o próximo jogo
    public function next()
    {
        $this->position++;
    }

    // Reseta a posição para o início
    public function rewind()
    {
        $this->position = 0;
    }

    // Verifica se a posição atual é válida
    public function valid()
    {
        return isset($this->games[$this->position]);
    }
}

// Coleção de jogos famosos da Nintendo solicitados
$games = new NintendoGamesCollection([
    ['title' => 'The Legend of Zelda: A Link to the Past', 'year' => 1991, 'genre' => 'Aventura'],
    ['title' => 'Super Mario World', 'year' => 1990, 'genre' => 'Plataforma'],
    ['title' => 'Top Gear', 'year' => 1992, 'genre' => 'Corrida'],
    ['title' => 'Donkey Kong Country', 'year' => 1994, 'genre' => 'Plataforma'],
]);

echo "Jogos da Nintendo:\n";
foreach ($games as $key => $game) {
    echo "Jogo na posição {$key}: {$game['title']} ({$game['year']}) - Gênero: {$game['genre']}\n";
}
