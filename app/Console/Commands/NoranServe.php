<?php

namespace App\Console\Commands;

use App\Servers\NoranServer;
use Illuminate\Console\Command;

class NoranServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noran:serve {--port=5002 : Port to run the server on. Defaults to 5002}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a noran tracker server on the specified port or port 5002 if no port is specified';

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
        $port = $this->option("port");
        $server = new NoranServer($port);
        $server->start();
    }
}
