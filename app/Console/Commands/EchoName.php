<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EchoName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'echo:name {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display name';

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
     * @return int
     */
    public function handle()
    {
        dd($this->argument('name'));
        return 0;
    }
}
