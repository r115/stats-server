<?php

namespace App\Console\Commands;

use App\Notifications\AlertMade;
use App\User;
use Illuminate\Console\Command;

class TestAF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:af';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $user = User::find(1);

        $this->info($user->phone);

        $user->notify(new AlertMade());
    }
}
