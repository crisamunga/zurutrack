<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NoranServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noran:serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a noran tracker server on the port specified by the NORAN_SERVER_PORT environment variable or port 5002 if no port is specified';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * port on which to run the server
     * @var int
     */
    private $port;

    private $connections = array();


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->port = env('NORAN_SERVER_PORT', 5002);
        $this->start();
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
