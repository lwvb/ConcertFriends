<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Concerts;

class SetupTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test function to check if everything did go as planned';

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
        $concerts = new Concerts();
        if($concerts->all()['total'] >= 3) {
            $this->info('Index has dummy data');
        } else {
            $this->error('Unable to get dummy data from elasticsearch index');
        }
    }
}
