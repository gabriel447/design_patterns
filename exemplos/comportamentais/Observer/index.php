<?php
// Exemplo do padrão Observer para sistema de assinantes de newsletter
// Comentários e saída em português

// Gerenciador de eventos que mantém os listeners por tipo de evento
class EventManager
{
    private $listeners = [];

    // Inscreve um listener para um tipo de evento
    public function subscribe(string $eventType, callable $listener)
    {
        if (!isset($this->listeners[$eventType])) {
            $this->listeners[$eventType] = [];
        }
        $this->listeners[$eventType][] = $listener;
    }

    // Remove um listener para um tipo de evento
    public function unsubscribe(string $eventType, callable $listenerToRemove)
    {
        if (isset($this->listeners[$eventType])) {
            $this->listeners[$eventType] = array_filter(
                $this->listeners[$eventType],
                function ($listener) use ($listenerToRemove) {
                    // Comparação simples para closures or callables
                    return $listener !== $listenerToRemove;
                }
            );
        }
    }

    // Notifica todos os listeners inscritos para um tipo de evento
    public function notify(string $eventType, $data = null)
    {
        if (isset($this->listeners[$eventType])) {
            foreach ($this->listeners[$eventType] as $listener) {
                call_user_func($listener, $data);
            }
        }
    }
}

// Sistema de newsletter que usa o EventManager para gerenciar assinaturas
class Newsletter
{
    public $events;
    private $subscribers = [];

    public function __construct()
    {
        $this->events = new EventManager();
    }

    // Método para assinar a newsletter
    public function subscribeUser(string $email)
    {
        if (!in_array($email, $this->subscribers)) {
            $this->subscribers[] = $email;
            echo "Newsletter: Usuário '{$email}' assinou a newsletter.\n";
            $this->events->notify("subscribe", $email);
        } else {
            echo "Newsletter: Usuário '{$email}' já está inscrito.\n";
        }
    }

    // Método para cancelar a assinatura
    public function unsubscribeUser(string $email)
    {
        if (($key = array_search($email, $this->subscribers)) !== false) {
            unset($this->subscribers[$key]);
            echo "Newsletter: Usuário '{$email}' cancelou a assinatura.\n";
            $this->events->notify("unsubscribe", $email);
        } else {
            echo "Newsletter: Usuário '{$email}' não está inscrito.\n";
        }
    }
}

// Listener que envia email quando o usuário assina
class EmailSubscriptionListener
{
    public function update($email)
    {
        echo "EmailSubscriptionListener: Enviando email de boas-vindas para {$email}.\n";
    }
}

// Listener que confirma cancelamento de assinatura
class EmailUnsubscriptionListener
{
    public function update($email)
    {
        echo "EmailUnsubscriptionListener: Confirmando cancelamento para {$email}.\n";
    }
}

// Demonstração do uso
$newsletter = new Newsletter();

$subscriptionListener = new EmailSubscriptionListener();
$unsubscriptionListener = new EmailUnsubscriptionListener();

// Inscreve os listeners nos eventos
$newsletter->events->subscribe("subscribe", [$subscriptionListener, 'update']);
$newsletter->events->subscribe("unsubscribe", [$unsubscriptionListener, 'update']);

// Usuários assinam e cancelam a newsletter
$newsletter->subscribeUser("usuario1@example.com");
$newsletter->subscribeUser("usuario2@example.com");
$newsletter->unsubscribeUser("usuario1@example.com");

// Usuário 1 cancela a assinatura e não deve mais receber emails
// Para simular isso, removemos o listener de subscribe para o usuário 1
// Como o EventManager não gerencia listeners por usuário, essa simulação é limitada

// Tentamos notificar novamente a inscrição para usuario1 (não deve acontecer pois ele cancelou)
$newsletter->subscribeUser("usuario1@example.com"); // Deve mostrar que já está inscrito, pois re-adicionamos no array

// Notifica um novo usuário
$newsletter->subscribeUser("usuario3@example.com");
