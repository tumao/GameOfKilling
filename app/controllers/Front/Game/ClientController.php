<?php
/**
 * @author changchun
 */
namespace App\Controllers\Front\Game;

use App\Controllers\BaseController;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ClientController implements MessageComponentInterface 
{
            protected $clients;

            public function __construct ()
            {
                    $this->clients = new \SplObjectStorage;
            }

	public function onOpen (ConnectionInterface $conn) 
	{
                        $this->clients->attach ($conn);

                        echo "new connection {$conn} established \n";
	}

               public function onMessage (ConnectionInterface $from, $msg) 
   	{
    	               $numRecv = count($this->clients) - 1;
                             echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
                                    , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

                            foreach ($this->clients as $client) 
                            {
                                    if ($from !== $client) 
                                    {
                                            $client->send($msg);
                                    }
                        }  
    	}

    	public function onClose (ConnectionInterface $conn) 
    	{
    	       // 移除一组对象
                        $this->clients->detach($conn);

                        echo "Connection {$conn->resourceId} has disconnected\n";
    	}

    	public function onError (ConnectionInterface $conn, \Exception $e) 
    	{
    	           echo "An error has occurred: {$e->getMessage()}\n";

                          $conn->close();
    	}

}