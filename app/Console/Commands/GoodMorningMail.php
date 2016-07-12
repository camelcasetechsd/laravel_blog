<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GoodMorningMailJob;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GoodMorningMail extends Command
{

    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'goodmorning-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send users an good morning mails each morning at 9 am ';

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
        $this->dispatch(new GoodMorningMailJob());
    }

}
