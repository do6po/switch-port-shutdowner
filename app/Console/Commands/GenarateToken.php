<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenarateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:gen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new token for access to switch handler';

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
        $token = str_random(32);

        $this->info(sprintf('New token: %s', $token));
    }
}
