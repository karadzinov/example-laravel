<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendToAll;
use App\Models\Product;

class sendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to Specific User';

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
        $product = Product::find(1);
        Mail::to($this->argument('user'))->send(new SendToAll($product));
        return 0;
    }
}
