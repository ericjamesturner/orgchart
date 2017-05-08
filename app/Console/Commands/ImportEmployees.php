<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill the closure table with data from the employees table.';

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
        $this->info("Importing into Table.");

        dispatch(new \App\Jobs\FillClosureTable);

        $this->info("Import Complete.");
    }
}
