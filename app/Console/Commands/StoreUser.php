<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class StoreUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user via command';

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
        $name = $this->ask('What is your name?');
        $email = $this->ask('What is your email?');
        $image = $this->ask('Where is your image?');
        $password = $this->secret('Setup your password');
        $role_id = rand(1,3);

        $user = '';

        if ($this->confirm('Do you wish to continue?', true)) {
            $user = User::create(
                [
                    'name' => $name,
                    'email' => $email,
                    'image' => $image,
                    'role_id' => $role_id,
                    'password' => bcrypt($password)
                ]
            );
        }


        $this->info('The command was successful!');

        dump($user);
        return 0;
    }
}
