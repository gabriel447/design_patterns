<?php

// A classe que gerencia os eventos e os ouvintes (listeners)
class Evento
{
    private $ouvintes = [];

    // Inscreve um ouvinte para um tipo de evento
    public function inscrever($evento, $ouvinte)
    {
        $this->ouvintes[$evento][] = $ouvinte;
    }

    // Notifica todos os ouvintes sobre um evento
    public function notificar($evento, $dado)
    {
        if (isset($this->ouvintes[$evento])) {
            foreach ($this->ouvintes[$evento] as $ouvinte) {
                $ouvinte($dado);
            }
        }
    }
}

// A classe da Newsletter
class Newsletter
{
    private $evento;
    private $inscritos = [];
    private $cancelados = [];

    public function __construct()
    {
        $this->evento = new Evento();
    }

    // Inscreve o usuário na newsletter
    public function inscreverUsuario($email)
    {
        if (!in_array($email, $this->inscritos)) {
            $this->inscritos[] = $email;
            echo "🎉 O usuário {$email} se inscreveu! Vamos enviar um e-mail de boas-vindas.\n";
            $this->evento->notificar("inscricao", $email);
        } else {
            echo "📩 O usuário {$email} já está inscrito!\n";
        }
    }

    // Cancela a inscrição do usuário
    public function cancelarInscricao($email)
    {
        if (($key = array_search($email, $this->inscritos)) !== false) {
            unset($this->inscritos[$key]);
            $this->cancelados[] = $email;
            echo "❌ O usuário {$email} cancelou a inscrição.\n";
            $this->evento->notificar("cancelamento", $email);
        } else {
            echo "⚠️ O usuário {$email} não está inscrito.\n";
        }
    }

    // Envia a newsletter para todos os inscritos, exceto os cancelados
    public function enviarNewsletter()
    {
        echo "\n🔔 Enviando newsletter para os inscritos...\n";

        // Envia para todos os que não cancelaram
        foreach ($this->inscritos as $email) {
            echo "📧 Enviando newsletter para {$email}...\n";
        }

        // Avisando os cancelados
        $this->evento->notificar("avisarCancelados", $this->cancelados);
    }

    // Inscreve um ouvinte nos eventos de inscrição ou cancelamento
    public function adicionarOuvinte($evento, $ouvinte)
    {
        $this->evento->inscrever($evento, $ouvinte);
    }
}

// Função que envia o e-mail de boas-vindas
$boasVindas = function($email) {
    echo "📧 Enviando e-mail de boas-vindas para {$email}.\n";
};

// Função que confirma o cancelamento
$confirmarCancelamento = function($email) {
    echo "📩 Confirmando o cancelamento de {$email}.\n";
};

// Função que avisa aos inscritos que um cancelamento ocorreu
$avisarCancelados = function($cancelados) {
    foreach ($cancelados as $email) {
        echo "🚫 O usuário {$email} não receberá a newsletter, pois cancelou a inscrição.\n";
    }
};

// Criando a instância da Newsletter
$newsletter = new Newsletter();

// Adicionando ouvintes
$newsletter->adicionarOuvinte("inscricao", $boasVindas);
$newsletter->adicionarOuvinte("cancelamento", $confirmarCancelamento);
$newsletter->adicionarOuvinte("avisarCancelados", $avisarCancelados);

// Testando
$newsletter->inscreverUsuario("joao@exemplo.com");
$newsletter->inscreverUsuario("maria@exemplo.com");
$newsletter->cancelarInscricao("joao@exemplo.com"); // João cancela a inscrição
$newsletter->enviarNewsletter();
$newsletter->inscreverUsuario("ana@exemplo.com");
$newsletter->enviarNewsletter();