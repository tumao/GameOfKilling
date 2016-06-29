<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Api\ChatController;

require "../../vendor/autoload.php";

$server = IoServer::factory(
	new HttpServer(
		new WsServer(
			new ChatController()
            		)
        	),
        	9979 
);

$server->run();