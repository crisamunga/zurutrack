<?php

namespace App\Console\Commands;

use App\Servers\CobanServer;
use Illuminate\Console\Command;

class CobanServe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coban:serve {--port=5001 : Port to run the server on. Defaults to 5001}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a coban tracker server on the specified port or port 5001 if no port is specified';

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
        $server = new CobanServer($port);
        $server->start();
    }
}
