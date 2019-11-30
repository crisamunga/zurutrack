<?php

namespace App\Servers;

class NoranServer
{
    /**
     * port on which to run the server
     * @var int
     */
    public $port;

    public function __construct($port)
    {
        $this->port = $port;
        $this->connections = array();
    }

    public function start()
    {
        $loop = \React\EventLoop\Factory::create();
        $factory = new \React\Datagram\Factory($loop);
        $address = "0.0.0.0:{$this->port}";

        $factory->createServer($address)
            ->then(
                function (\React\Datagram\Socket $server) {
                    $server->on('message', function ($message, $address, $server) {
                        $this->onMessage($message, $address, $server);
                    });
                },
                function ($error) {
                    error_log("ERROR: " . $error->getMessage() . "\n");
                }
            );

        echo "Started Noran tracker server on udp://$address\n";
        $loop->run();
    }


    // TODO: Broadcast event for tracker message and connection
    public function onMessage($message, $address, $server)
    {
        echo 'client ' . $address . ': ' . $message . PHP_EOL;
    }
}
