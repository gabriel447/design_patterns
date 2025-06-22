<?php

// Estado base
abstract class State
{
    protected AudioPlayer $player;

    public function __construct(AudioPlayer $player)
    {
        $this->player = $player;
    }

    abstract public function clickLock(): void;
    abstract public function clickPlay(): void;
    abstract public function clickNext(): void;
    abstract public function clickPrevious(): void;
}

// Estado: Travado
class LockedState extends State
{
    public function clickLock(): void
    {
        echo "🔓 Desbloqueando o player...\n";
        $this->player->changeState($this->player->isPlaying() ? new PlayingState($this->player) : new ReadyState($this->player));
    }

    public function clickPlay(): void
    {
        echo "🔒 Player bloqueado! Ignorando Play.\n";
    }

    public function clickNext(): void
    {
        echo "🔒 Player bloqueado! Ignorando Próximo.\n";
    }

    public function clickPrevious(): void
    {
        echo "🔒 Player bloqueado! Ignorando Anterior.\n";
    }
}

// Estado: Pronto para tocar
class ReadyState extends State
{
    public function clickLock(): void
    {
        echo "🔒 Bloqueando o player...\n";
        $this->player->changeState(new LockedState($this->player));
    }

    public function clickPlay(): void
    {
        $this->player->startPlayback();
        $this->player->changeState(new PlayingState($this->player));
    }

    public function clickNext(): void
    {
        $this->player->nextSong();
    }

    public function clickPrevious(): void
    {
        $this->player->previousSong();
    }
}

// Estado: Tocando
class PlayingState extends State
{
    public function clickLock(): void
    {
        echo "🔒 Bloqueando o player durante reprodução...\n";
        $this->player->changeState(new LockedState($this->player));
    }

    public function clickPlay(): void
    {
        $this->player->stopPlayback();
        $this->player->changeState(new ReadyState($this->player));
    }

    public function clickNext(): void
    {
        $this->player->fastForward(5);
    }

    public function clickPrevious(): void
    {
        $this->player->rewind(5);
    }
}

// Contexto: AudioPlayer
class AudioPlayer
{
    private State $state;
    private bool $playing = false;

    public function __construct()
    {
        $this->state = new ReadyState($this);
    }

    public function changeState(State $state): void
    {
        $this->state = $state;
    }

    public function clickLock(): void
    {
        $this->state->clickLock();
    }

    public function clickPlay(): void
    {
        $this->state->clickPlay();
    }

    public function clickNext(): void
    {
        $this->state->clickNext();
    }

    public function clickPrevious(): void
    {
        $this->state->clickPrevious();
    }

    public function startPlayback(): void
    {
        $this->playing = true;
        echo "🎵 Playback iniciado\n";
    }

    public function stopPlayback(): void
    {
        $this->playing = false;
        echo "⏸️ Playback parado\n";
    }

    public function nextSong(): void
    {
        echo "⏭️ Próxima música\n";
    }

    public function previousSong(): void
    {
        echo "⏮️ Música anterior\n";
    }

    public function fastForward(int $seconds): void
    {
        echo "⏩ Avançando {$seconds} segundos\n";
    }

    public function rewind(int $seconds): void
    {
        echo "⏪ Voltando {$seconds} segundos\n";
    }

    public function isPlaying(): bool
    {
        return $this->playing;
    }
}

// ---------------------
// EXEMPLOS DE EXECUÇÃO
// ---------------------

echo "=== Iniciando AudioPlayer ===\n";

$player = new AudioPlayer();

echo "\n>>> Play\n";
$player->clickPlay();

echo "\n>>> Next\n";
$player->clickNext();

echo "\n>>> Lock\n";
$player->clickLock();

echo "\n>>> Play bloqueado\n";
$player->clickPlay();

echo "\n>>> Unlock\n";
$player->clickLock();

echo "\n>>> Stop\n";
$player->clickPlay();

echo "\n>>> Previous\n";
$player->clickPrevious();