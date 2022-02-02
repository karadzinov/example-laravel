<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendToAll;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class sendMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send every 5 mins mail';

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
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendToAll($product));
        }

        return 0;
    }
}
