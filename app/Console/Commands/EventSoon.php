<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Event;
use App\Subscription;
use App\User;

class EventSoon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'beeronaute:eventcron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email when event is close';

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
           
    }
}
