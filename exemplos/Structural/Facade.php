<?php
// Exemplo realista do padrão Facade em PHP: Sistema de Home Theater

// Subsystem: DVD Player
class DVDPlayer {
    public function on() {
        return "DVD Player ligado\n";
    }
    public function play($movie) {
        return "DVD Player tocando o filme: $movie\n";
    }
    public function stop() {
        return "DVD Player parado\n";
    }
    public function off() {
        return "DVD Player desligado\n";
    }
}

// Subsystem: Amplifier
class Amplifier {
    public function on() {
        return "Amplificador ligado\n";
    }
    public function setVolume($level) {
        return "Amplificador volume ajustado para $level\n";
    }
    public function off() {
        return "Amplificador desligado\n";
    }
}

// Subsystem: Projector
class Projector {
    public function on() {
        return "Projetor ligado\n";
    }
    public function wideScreenMode() {
        return "Projetor em modo widescreen\n";
    }
    public function off() {
        return "Projetor desligado\n";
    }
}

// Subsystem: Theater Lights
class TheaterLights {
    public function dim($level) {
        return "Luzes do teatro ajustadas para nível $level\n";
    }
    public function on() {
        return "Luzes do teatro ligadas\n";
    }
}

// Facade
class HomeTheaterFacade {
    private $dvdPlayer;
    private $amplifier;
    private $projector;
    private $lights;

    public function __construct(DVDPlayer $dvdPlayer, Amplifier $amplifier, Projector $projector, TheaterLights $lights) {
        $this->dvdPlayer = $dvdPlayer;
        $this->amplifier = $amplifier;
        $this->projector = $projector;
        $this->lights = $lights;
    }

    public function watchMovie($movie) {
        $result = "Preparando para assistir o filme...\n";
        $result .= $this->lights->dim(10);
        $result .= $this->projector->on();
        $result .= $this->projector->wideScreenMode();
        $result .= $this->amplifier->on();
        $result .= $this->amplifier->setVolume(5);
        $result .= $this->dvdPlayer->on();
        $result .= $this->dvdPlayer->play($movie);
        return $result;
    }

    public function endMovie() {
        $result = "Desligando o sistema de home theater...\n";
        $result .= $this->dvdPlayer->stop();
        $result .= $this->dvdPlayer->off();
        $result .= $this->amplifier->off();
        $result .= $this->projector->off();
        $result .= $this->lights->on();
        return $result;
    }
}

// Código cliente
$dvdPlayer = new DVDPlayer();
$amplifier = new Amplifier();
$projector = new Projector();
$lights = new TheaterLights();

$homeTheater = new HomeTheaterFacade($dvdPlayer, $amplifier, $projector, $lights);

echo $homeTheater->watchMovie("Inception");
echo "\n";
echo $homeTheater->endMovie();
