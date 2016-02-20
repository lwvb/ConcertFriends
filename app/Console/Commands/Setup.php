<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the application';

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
        $this->info('Setup is starting...');
        $this->call('setup:elastic');
        $this->call('setup:dummydata');
        $this->call('setup:test');
        $this->info('Setup is done, the application is ready to be used!');
    }
}
