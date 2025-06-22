<?php
// Classe que representa uma coleção de jogos da Nintendo
class NintendoGamesCollection implements Iterator
{
    private array $games = [];
    private int $position = 0;

    public function __construct(array $games)
    {
        $this->games = $games;
        $this->position = 0;
    }

    // Retorna o jogo atual
    public function current(): mixed
    {
        return $this->games[$this->position];
    }

    // Retorna a chave atual (índice ou posição do jogo)
    public function key(): int
    {
        return $this->position;
    }

    // Avança para o próximo jogo
    public function next(): void
    {
        $this->position++;
    }

    // Reseta a posição para o início
    public function rewind(): void
    {
        $this->position = 0;
    }

    // Verifica se a posição atual é válida
    public function valid(): bool
    {
        return isset($this->games[$this->position]);
    }
}

// Coleção de jogos mais famosos da Nintendo
$games = new NintendoGamesCollection([
    ['title' => 'Super Mario Bros.', 'year' => 1985, 'genre' => 'Plataforma'],
    ['title' => 'The Legend of Zelda: Ocarina of Time', 'year' => 1998, 'genre' => 'Aventura'],
    ['title' => 'Super Mario 64', 'year' => 1996, 'genre' => 'Plataforma'],
    ['title' => 'The Legend of Zelda: Breath of the Wild', 'year' => 2017, 'genre' => 'Aventura'],
    ['title' => 'Pokémon Red/Blue', 'year' => 1996, 'genre' => 'RPG'],
    ['title' => 'Donkey Kong Country', 'year' => 1994, 'genre' => 'Plataforma'],
    ['title' => 'Metroid Prime', 'year' => 2002, 'genre' => 'Aventura'],
    ['title' => 'Super Smash Bros. Ultimate', 'year' => 2018, 'genre' => 'Luta'],
    ['title' => 'Animal Crossing: New Horizons', 'year' => 2020, 'genre' => 'Simulação'],
    ['title' => 'Mario Kart 8 Deluxe', 'year' => 2017, 'genre' => 'Corrida'],
    ['title' => 'Splatoon 2', 'year' => 2017, 'genre' => 'Tiro'],
    ['title' => 'Fire Emblem: Three Houses', 'year' => 2019, 'genre' => 'Estratégia'],
    ['title' => 'Super Mario Odyssey', 'year' => 2017, 'genre' => 'Plataforma'],
    ['title' => 'Luigi\'s Mansion 3', 'year' => 2019, 'genre' => 'Aventura'],
]);

echo "Jogos mais famosos da Nintendo:\n";
foreach ($games as $key => $game) {
    echo "Jogo na posição {$key}: {$game['title']} ({$game['year']}) - Gênero: {$game['genre']}\n";
}
