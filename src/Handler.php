<?php

namespace Amplify;

use Aerys\WebSocket;
use Aerys\Request;
use Aerys\Response;
use Aerys\Websocket\Endpoint;
use Aerys\Websocket\Message;

class Handler implements WebSocket
{
    private $clients = 0;

    private $clicks = 0;

    private $endpoint;

    public function onStart(Endpoint $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function onHandshake(Request $request, Response $response)
    {
        return $request->getConnectionInfo()['client_addr'];
    }

    public function onOpen(int $clientId, $handshakeData)
    {
        $this->clients++;

        $this->sendUpdate();
    }

    public function onData(int $clientId, Message $msg)
    {
        $message = json_decode(yield $msg, true);

        if (!isset($message['click'])) {
            return;
        }

        $this->clicks++;

        $this->sendUpdate();
    }

    public function onClose(int $clientId, int $code, string $reason)
    {
        $this->clients--;

        $this->sendUpdate();
    }

    public function onStop()
    {
    }

    private function sendUpdate()
    {
        $this->endpoint->send(null, json_encode([
            'global'  => $this->clicks,
            'clients' => $this->clients,
        ]));
    }
}
