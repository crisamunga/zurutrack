<?php

namespace App\Console\Commands;

use App\Jobs\LogTrackerAlarm;
use App\Jobs\LogTrackerMessage;
use App\Jobs\UpdateTrackerLocation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use React\Socket\ConnectionInterface;

class CobanServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coban:serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a coban tracker server on the port specified by the COBAN_SERVER_PORT environment variable or port 5001 if no port is specified';

    /**
     * Port used by the server. 5001 by default
     */
    private $port;

    private $server;

    private $redis;

    private $clients = array();

    private $redis_channel = "zurutrack_database_test";

    private $model_name = "Coban 103";

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->port = env('COBAN_SERVER_PORT', 5001);
        $this->start();
    }

    public function start()
    {
        $loop = \React\EventLoop\Factory::create();
        $factory = new \Clue\React\Redis\Factory($loop);

        $this->redis = $factory->createLazyClient('localhost');
        $this->redis->subscribe($this->redis_channel);
        $this->redis->on('message', function ($channel, $payload) {
            var_dump($channel, json_decode($payload));
        });

        $this->server = new \React\Socket\Server("0.0.0.0:{$this->port}", $loop);
        $this->server->on("connection", function (ConnectionInterface $connection) {
            $this->onConnection($connection);
        });

        echo "Started Coban tracker server on {$this->server->getAddress()}\n";
        $loop->run();
    }

    // TODO: Emit necessary events to the main system here
    private function onConnection(ConnectionInterface $connection)
    {
        $address = $connection->getRemoteAddress();

        if (!array_key_exists($address, $this->clients)) {
            $this->clients[$address] = [
                'connection' => $connection,
                'serial' => null
            ];
        }

        $connection->on("data", function ($message) use ($connection) {
            if ($this->isLoginMessage($message)) {
                // Handle device login message here
                $connection->write("LOAD");
                $imei = $this->getImeiFromLoginMessage($message);
                echo $imei . " Connected";
            } else if ($this->isHeartbeatMessage($message)) {
                // Handle device hearbeat message here
                $connection->write("ON");
            } else if ($this->isNoSignalMessage($message)) {
                // Handle no gps signal on device here
            } else if ($this->isDataMessage($message)) {
                // If it is a valid data message
                $parsedData = $this->parseIncomingMessage($message);
                $this->processData($parsedData);
            } else {
                // Invalid message received
                // $connection->close();
            }
        });

        $connection->on('close', function () use ($address) {
            if (array_key_exists($address, $this->clients)) {
                unset($this->clients[$address]);
            }
        });
    }

    /**
     * Checks whether the incoming message is a login message
     * @param string message : Message from the tracking device
     * @return boolean true if the message is a valid login message
     */
    private function isLoginMessage($message)
    {
        // Validate against ##,imei:121212121212122,A;
        $loginRegex = "/^##,imei:([0-9]+),A;[\r\n]?$/";
        return preg_match($loginRegex, $message);
    }

    /**
     * Checks whether the incoming message is a heartbeat message
     * @param string message : Message from the tracking device
     * @return boolean true if the message is a valid heartbeat message
     */
    private function isHeartbeatMessage($message)
    {
        // Validate against 121212121212122;
        $heartbeatRegex = "/^([0-9]+);[\r\n]?$/";
        return preg_match($heartbeatRegex, $message);
    }

    /**
     * Checks whether the incoming message is a data message
     * @param string message : Message from the tracking device
     * @return boolean true if the message is a valid data message
     */
    private function isDataMessage($message)
    {
        // Validate against imei:121212121212122,tracker,190118081747,122345567889,F,051743.000,A,0119.3236,S,03648.3090,E,0.00,;
        $dataRegex = "/^imei:([0-9]+),([a-zA-Z0-9 ]+),([0-9]{10,12}),([0-9]+),F,([0-9]+.[0-9]{3}),A,([0-9]{4}.[0-9]{4}),[NS],([0-9]{5}.[0-9]{4}),[EW],([0-9.]+),(.*)?;[\r\n]?$/";
        return preg_match($dataRegex, $message);
    }

    /**
     * Checks whether the incoming message is a no signal message
     * @param string message : Message from the tracking device
     * @return boolean true if the message is a valid no signal message
     */
    private function isNoSignalMessage($message)
    {
        // Validate against imei:121212121212122,tracker,190118081747,122345567889,F,051743.000,A,0119.3236,S,03648.3090,E,0.00,;
        $noSignalRegex = "/^imei:([0-9]+),([a-zA-Z0-9 ]+),([0-9]{10,12}),([0-9]+),L,(.*)?;[\r\n]?$/";
        return preg_match($noSignalRegex, $message);
    }

    /**
     * Returns the imei from a login message
     * @param string message: Login mesage from the tracker
     * @return string imei of the tracker extracted from the message
     */
    private function getImeiFromLoginMessage($message)
    {
        $message_regex = "/[,:]+/";
        $rawData = preg_split($message_regex, $message);
        return $rawData[2];
    }

    /**
     * Parses the received message from the tracker and formats it into an associative array
     * @param string message : Message from the tracking device
     * @return array Associative array containing the data sent by the tracker
     */
    private function parseIncomingMessage($message)
    {

        $message_regex = "/[,:]+/";
        $rawData = preg_split($message_regex, $message);

        $data = [];
        $data["model"] = $this->model_name;
        $data["serial"] = $rawData[1];

        $responses = config('coban_gps_protocol.receive_command');
        if (array_key_exists($rawData[2], $responses)) {
            $data["message"] = $responses[$rawData[2]];
        } else {
            $data["message"] = null;
        }

        $data["time"] = Carbon::parse("20$rawData[3]");
        $data["phone_number"] = $rawData[4];
        $data["signal_present"] = $rawData[5] == "F";

        if (!$data["signal_present"]) {
            $data["latitude"] = null;
            $data["longitude"] = null;
            $data["speed"] = null;
        } else {
            $latdeg = (float) substr($rawData[8], 0, 2);
            $latmin = (float) substr($rawData[8], 2);
            $lat = $latdeg + ($latmin / 60);
            $lat *= ($rawData[9] == "S" ? -1 : 1);
            $data['latitude'] = $lat;

            $longdeg = (float) substr($rawData[10], 0, 3);
            $longmin = (float) substr($rawData[10], 3);
            $long = $longdeg + ($longmin / 60);
            $long *= ($rawData[11] == "W" ? -1 : 1);
            $data['longitude'] = $long;

            $data["speed"] = (float) $rawData[12];
        }

        return $data;
    }

    /**
     * Processes received data and dispatches relevant jobs
     */
    public function processData($data)
    {
        if ($data['message']) {
            if ($data['message']['type'] == 'location') {
                UpdateTrackerLocation::dispatch($data);
            } else if ($data['message']['type'] == 'alarm') {
                LogTrackerAlarm::dispatch($data);
            } else if ($data['message']['type'] == 'response') {
                LogTrackerMessage::dispatch($data);
            }
        }
    }
}
